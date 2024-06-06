<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\kategori;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StorekategoriRequest;
use App\Http\Requests\UpdatekategoriRequest;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['kategori'] = kategori::orderBy('nama')->get();
        $title = 'Yakin ingin menghapus?';
        $text = "Aksi ini tidak dapat dikembalikan!";
        confirmDelete($title, $text);
        return view("kategori/index", compact('data'));
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
    public function store(StorekategoriRequest $request)
    {
        $validated = $request->validated();

        try {
            $validated = $request->validated();

            kategori::create($validated);

            Alert::success('Sukses', 'Kategori berhasil disimpan');
            return redirect()->route('kategori.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal menyimpan kategori');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kategori $kategori)
    {
        $data['kategori'] = $kategori;
        return view("kategori/edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatekategoriRequest $request, kategori $kategori)
    {
        try {
            $validated = $request->validated();

            $kategori->update($validated);

            Alert::success('Sukses', 'Kategori berhasil diperbarui');
            return redirect()->route('kategori.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal memperbarui kategori');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kategori $kategori)
    {
        try {
            $kategori->delete();
            Alert::success('Berhasil', 'Kategori berhasil dihapus');
        } catch (Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus kategori');
        }
        return redirect()->route('kategori.index');
    }
}
