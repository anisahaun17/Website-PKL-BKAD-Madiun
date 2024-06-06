<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Assets;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreAssetsRequest;
use App\Http\Requests\UpdateAssetsRequest;
use App\Models\AssetDetail;
use App\Models\Jenis;
use App\Models\Kategori;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['asset'] = Assets::orderBy('nama')->get();
        $data['kategori'] = Kategori::orderBy('nama')->get();
        $data['jenis'] = Jenis::select('id', 'nama', 'kategori_id')->orderBy('kategori_id')->orderBy('nama')->get();
        $title = 'Yakin ingin menghapus?';
        $text = "Aksi ini tidak dapat dikembalikan!";
        confirmDelete($title, $text);
        return view("asset/index", compact('data'));
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
    public function store(StoreAssetsRequest $request)
    {
        $validated = $request->validated();

        try {
            $validated = $request->validated();

            $validated['jenis_id'] = $validated['jenis'];
            unset($validated['jenis']);
            unset($validated['kategori']);

            $newAsset = Assets::create($validated);

            Alert::success('Sukses', 'Asset berhasil disimpan');
            return redirect()->route('asset.detail', $newAsset->id);
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal menyimpan asset');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Assets $assets)
    {
        $data['asset'] = $assets;
        $title = 'Yakin ingin menghapus?';
        $text = "Aksi ini tidak dapat dikembalikan!";
        confirmDelete($title, $text);
        return view("asset/show", compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assets $assets)
    {
        $data['asset'] = $assets;
        $data['kategori'] = Kategori::orderBy('nama')->get();
        $data['jenis'] = Jenis::select('id', 'nama', 'kategori_id')->orderBy('kategori_id')->orderBy('nama')->get();
        return view("asset/edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssetsRequest $request, Assets $assets)
    {
        if (!$assets->isUsedInSkrd()) {
            Alert::error('Gagal', 'Tidak dapat mengedit asset yang sedang digunakan di Skrd.');
            return redirect()->back();
        }

        try {
            $validated = $request->validated();

            $validated['jenis_id'] = $validated['jenis'];
            unset($validated['jenis']);
            unset($validated['kategori']);

            $assets->update($validated);

            Alert::success('Sukses', 'Asset berhasil diperbarui');
            return redirect()->route('asset.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal memperbarui asset');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assets $assets)
    {
        try {
            $assets->delete();
            Alert::success('Berhasil', 'Asset berhasil dihapus');
        } catch (Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus asset');
        }
        return redirect()->route('asset.index');
    }
}
