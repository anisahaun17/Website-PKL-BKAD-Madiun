<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\jenis;
use App\Models\Kategori;
use App\Http\Requests\StorejenisRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\UpdatejenisRequest;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['jenis'] = Jenis::orderBy('kategori_id')->orderBy('nama')->get();
        $data['kategori'] = Kategori::orderBy('nama')->get();
        $title = 'Yakin ingin menghapus?';
        $text = "Aksi ini tidak dapat dikembalikan!";
        confirmDelete($title, $text);
        return view("jenis/index", compact('data'));
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
    public function store(StorejenisRequest $request)
    {
        try {
            $validated = $request->validated();

            $validated['kategori_id'] = $validated['kategori'];
            unset($validated['kategori']);

            jenis::create($validated);

            Alert::success('Sukses', 'Jenis berhasil disimpan');
            return redirect()->route('jenis.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal menyimpan jenis');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(jenis $jenis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jenis $jenis)
    {
        $data['jenis'] = $jenis;
        $data['kategori'] = Kategori::orderBy('nama')->get();
        return view("jenis/edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatejenisRequest $request, jenis $jenis)
    {
        try {
            $validated = $request->validated();

            $validated['kategori_id'] = $validated['kategori'];
            unset($validated['kategori']);

            $jenis->update($validated);

            Alert::success('Sukses', 'Jenis berhasil diperbarui');
            return redirect()->route('jenis.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal memperbarui jenis');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jenis $jenis)
    {
        try {
            $jenis->delete();
            Alert::success('Berhasil', 'Jenis berhasil dihapus');
        } catch (Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus jenis');
        }
        return redirect()->route('jenis.index');
    }
}
