<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\penanggungJawab;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StorepenanggungJawabRequest;
use App\Http\Requests\UpdatepenanggungJawabRequest;
use App\Models\jabatan;

class PenanggungJawabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pj'] = penanggungJawab::orderBy('nama')->get();
        $data['jabatan'] = jabatan::orderBy('nama')->get();
        $title = 'Yakin ingin menghapus?';
        $text = "Aksi ini tidak dapat dikembalikan!";
        confirmDelete($title, $text);
        return view("penanggungJawab.index", compact('data'));
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
    public function store(StorepenanggungJawabRequest $request)
    {
        $validated = $request->validated();

        try {
            $validated = $request->validated();


            $validated['jabatan_id'] = $validated['jabatan'];
            unset($validated['jabatan']);

            penanggungJawab::create($validated);

            Alert::success('Sukses', 'Penanggung jawab berhasil disimpan');
            return redirect()->route('pj.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal menyimpan penanggung jawab');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(penanggungJawab $penanggungJawab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(penanggungJawab $penanggungJawab)
    {
        $data['pj'] = $penanggungJawab;
        $data['jabatan'] = jabatan::orderBy('nama')->get();
        return view("penanggungJawab.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepenanggungJawabRequest $request, penanggungJawab $penanggungJawab)
    {
        try {
            $validated = $request->validated();


            $validated['jabatan_id'] = $validated['jabatan'];
            unset($validated['jabatan']);

            $penanggungJawab->update($validated);

            Alert::success('Sukses', 'Penanggung jawab berhasil diperbarui');
            return redirect()->route('pj.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal memperbarui penanggung jawab');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(penanggungJawab $penanggungJawab)
    {
        try {
            $penanggungJawab->delete();
            Alert::success('Berhasil', 'Penanggung jawab berhasil dihapus');
        } catch (Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus penanggung jawab');
        }
        return redirect()->route('pj.index');
    }
}
