<?php

namespace App\Http\Controllers;

use App\Models\Sewa;
use App\Models\Skrd;
use App\Models\Petugas;
use App\Models\SewaDetail;
use App\Models\penanggungJawab;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\StoreSkrdRequest;
use App\Http\Requests\UpdateSkrdRequest;
use RealRashid\SweetAlert\Facades\Alert;

class SkrdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($status)
    {
        switch ($status) {
            case 'belum-terbit':
                $data['skrd'] = Sewa::doesntHave('skrd')->get();
                $data['penanggungJawab'] = penanggungJawab::select('id')->first()->id;
                break;
            case 'terbit':
                $data['petugas'] = Petugas::all();
                $data['skrd'] = Skrd::doesntHave('pembayaran')->get();
                break;
            case 'selesai':
                $data['skrd'] = Skrd::has('pembayaran')->get();
                break;
        }

        return view("skrd.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(penanggungJawab $penanggungJawab, Sewa $sewa)
    {
        $terbilang = $sewa->sewaDetail()->sum('harga');
        if ($terbilang > 0) {
            Skrd::firstOrCreate([
                'kode_transaksi' => $sewa->kode_transaksi,
            ], [
                'penanggung_jawab_id' => $penanggungJawab->id,
                'terbilang' => 'tes',
                'tanggal_cetak' => Date('Y-m-d', time())
            ]);
            Alert::success('Sukses', 'Berhasil menerbitkan SKRD');
            return redirect()->back();
        } else {
            Alert::error('Error', 'Gagal menerbitkan SKRD, transaksi tersebut masih kosong');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Skrd $skrd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skrd $skrd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSkrdRequest $request, Skrd $skrd, $status)
    {
        try {
            switch ($status) {
                case 'pengurangan':
                    $request->validate([
                        'persentase' => 'required|numeric|min:0', // Add any other validation rules as needed
                    ]);

                    // Get the total harga from related sewaDetail
                    $totalHarga = $skrd->sewa->sewaDetail->sum('harga');
                
                    // Calculate the nominal deduction based on the percentage
                    $persentase = $request->input('persentase', 0); // Ensure the field is present in the request
                    $nominalPengurangan = ($persentase / 100) * $totalHarga;
                
                    // Update the Skrd model with the calculated values
                    $skrd->update([
                        'pengurangan' => $nominalPengurangan,
                    ]);

                    dd($persentase, $totalHarga, $nominalPengurangan);
                
                    Alert::success('Sukses', 'Berhasil menambahkan pengurangan');
                    break;
                case 'denda':
                    $batasPembayaran = (new \DateTime($skrd->sewa->tgl_sewa_mulai))->sub(new \DateInterval('P1D')); //27 1 2024
                    $selisihBulan = $batasPembayaran->diff(new \DateTime(now()))->m;
                    $persentaseDenda = 0.02;
                    $harga = $skrd->sewa->sewaDetail->sum('harga');
                    $denda = 0;
                    if ($selisihBulan > 0) {
                        $skrd->update([
                            'tanggal_cetak' => now(),
                            'denda' => $harga * $persentaseDenda * $selisihBulan
                        ]);
                        Alert::success('Sukses', 'Berhsail menambahkan denda');
                    } else {
                        $skrd->update([
                            'denda' => null
                        ]);
                        Alert::warning('Gagal', 'Belum masuk hitungan denda');
                    }
                    break;
            }
            return redirect()->route('skrd.index', 'terbit');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal memperbarui SKRD');
            return redirect()->back();
        }
    }

    public function print(Skrd $skrd)
    {
        $data = [
            'title' => 'SKRD',
            'skrd' => $skrd,
        ];

        $fileName = 'skrd.pdf';
        $pdf = Pdf::loadView('template.skrd', $data);
        // Mendefinisikan opsi unduhan
        $options = [
            'Content-Type' => 'application/pdf',
        ];

        // Mengembalikan respons PDF untuk diunduh
        return $pdf->download($fileName, $options);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skrd $skrd)
    {
        //
    }
}
