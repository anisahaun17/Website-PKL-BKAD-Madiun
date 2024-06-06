<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Jabatan;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StorejabatanRequest;
use App\Http\Requests\UpdatejabatanRequest;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['jabatan'] = Jabatan::orderBy('nama')->get();
        $title = 'Yakin ingin menghapus?';
        $text = "Aksi ini tidak dapat dikembalikan!";
        confirmDelete($title, $text);
        return view("jabatan/index", compact('data'));
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
    public function store(StorejabatanRequest $request)
    {
        $validated = $request->validated();

        try {
            $validated = $request->validated();

            Jabatan::create($validated);

            Alert::success('Sukses', 'Jabatan berhasil disimpan');
            return redirect()->route('jabatan.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal menyimpan jabatan');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jabatan $jabatan)
    {
        $data['jabatan'] = $jabatan;
        return view("jabatan/edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatejabatanRequest $request, jabatan $jabatan)
    {
        try {
            $validated = $request->validated();

            $jabatan->update($validated);

            Alert::success('Sukses', 'Jabatan berhasil diperbarui');
            return redirect()->route('jabatan.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal memperbarui jabatan');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jabatan $jabatan)
    {
        try {
            $jabatan->delete();
            Alert::success('Berhasil', 'Jabatan berhasil dihapus');
        } catch (Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus jabatan');
        }
        return redirect()->route('jabatan.index');
    }
}
