<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Petugas;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StorePetugasRequest;
use App\Http\Requests\UpdatePetugasRequest;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['petugas'] = Petugas::orderBy('nama')->get();
        $title = 'Yakin ingin menghapus?';
        $text = "Aksi ini tidak dapat dikembalikan!";
        confirmDelete($title, $text);
        return view("petugas.index", compact('data'));
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
    public function store(StorePetugasRequest $request)
    {

        try {
            $validated = $request->validated();

            Petugas::create($validated);

            Alert::success('Sukses', 'Petugas berhasil disimpan');
            return redirect()->route('petugas.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal menyimpan petugas');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Petugas $petugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Petugas $petugas)
    {
        $data['petugas'] = $petugas;
        return view("petugas.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePetugasRequest $request, Petugas $petugas)
    {
        try {
            $validated = $request->validated();

            $petugas->update($validated);

            Alert::success('Sukses', 'Petugas berhasil diperbarui');
            return redirect()->route('petugas.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal memperbarui petugas');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Petugas $petugas)
    {
        try {
            $petugas->delete();
            Alert::success('Berhasil', 'Petugas berhasil dihapus');
        } catch (Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus petugas');
        }
        return redirect()->route('petugas.index');
    }
}
