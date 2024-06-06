<?php

namespace App\Http\Controllers;

use App\Models\Skrd;
use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StorePembayaranRequest;
use App\Http\Requests\UpdatePembayaranRequest;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pembayaran'] = Pembayaran::orderBy('tanggal_pembayaran')->get();
        $title = 'Yakin ingin menghapus?';
        $text = "Aksi ini tidak dapat dikembalikan!";
        confirmDelete($title, $text);
        return view("pembayaran.index", compact('data'));
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
    public function store(StorePembayaranRequest $request, Skrd $skrd)
    {
        try {
            $validated = $request->validated();

            $validated['petugas_id'] = $validated['petugas'];
            $validated['skrd_id'] = $skrd->id;
            $validated['total'] = $skrd->sewa->sewaDetail->sum('harga');
            unset($validated['petugas']);

            $bayarId = Pembayaran::create($validated);

            Alert::success('Sukses', 'Pembayaran berhasil disimpan');
            return redirect()->route('pembayaran.detail', $bayarId);
        } catch (\Exception $e) {
            dd($e);
            Alert::error('Error', 'Gagal menyimpan pembayaran');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        $data['pembayaran'] = $pembayaran;
        return view("pembayaran.show", compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function print(Pembayaran $pembayaran)
    {
        $data = [
            'title' => 'Invoice Pembayaran',
            'pembayaran' => $pembayaran,
        ];

        // Nama file PDF yang akan diunduh
        $fileName = 'invoice_pembayaran.pdf';

        // Load view dan konversi ke PDF
        $pdf = Pdf::loadView('template.pembayaran', $data);

        // Mendefinisikan opsi unduhan
        $options = [
            'Content-Type' => 'application/pdf',
        ];

        // Mengembalikan respons PDF untuk diunduh
        return $pdf->download($fileName, $options);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePembayaranRequest $request, Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        //
    }
}