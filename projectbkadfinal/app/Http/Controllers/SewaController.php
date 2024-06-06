<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Sewa;
use App\Models\Jenis;
use App\Models\Kategori;
use App\Models\SewaDetail;
use Illuminate\Support\Facades\Event;
use App\Http\Requests\StoreSewaRequest;
use Illuminate\Database\QueryException;
use App\Http\Requests\UpdateSewaRequest;
use RealRashid\SweetAlert\Facades\Alert;

class SewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['sewa'] = Sewa::orderBy('nama')->get();
        $data['kategori'] = Kategori::all();
        $title = 'Yakin ingin menghapus?';
        $text = "Aksi ini tidak dapat dikembalikan!";
        confirmDelete($title, $text);
        return view("sewa.index", compact('data'));
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
    public function store(StoreSewaRequest $request)
    {
        try {
            $validated = $request->validated();

            $validated['asset_id'] = $validated['asset'];
            unset($validated['asset']);

            Sewa::create($validated);

            Alert::success('Sukses', 'Data penyewa berhasil disimpan');
            return redirect()->route('sewa.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Gagal menyimpan sewa');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sewa $sewa)
    {
        $data['sewa'] = $sewa;
        $title = 'Yakin ingin menghapus?';
        $text = "Aksi ini tidak dapat dikembalikan!";
        confirmDelete($title, $text);
        return view("sewa.show", compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sewa $sewa)
    {
        $data['sewa'] = $sewa;
        return view("sewa.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSewaRequest $request, Sewa $sewa)
    {
        if ($sewa->skrd) {
            Alert::error('Gagal', 'Tidak dapat mengubah data sewa yang sudah digunakan di Skrd.');
            return redirect()->back();
        }
        try {
            $validated = $request->validated();

            $sewa->update($validated);

            Alert::success('Sukses', 'Data penyewa berhasil diperbarui');
            return redirect()->route('sewa.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Gagal memperbarui data penyewa');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sewa $sewa)
    {
        try {
            $sewa->delete();
            Alert::success('Berhasil', 'Data penyewa berhasil dihapus');
        } catch (QueryException $e) {
            if ($e->getCode() == 23000)
                Alert::warning('Gagal', 'Tidak dapat menghapus transaksi, Transaksi ini sudah terbit skrd');
        } catch (Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data penyewa');
        }
        return redirect()->route('sewa.index');
    }
}
