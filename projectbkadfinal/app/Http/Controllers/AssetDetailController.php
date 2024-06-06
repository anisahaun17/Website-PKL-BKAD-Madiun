<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Jenis;
use App\Models\Assets;
use App\Models\AssetDetail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreAssetDetailRequest;
use App\Http\Requests\UpdateAssetDetailRequest;

class AssetDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreAssetDetailRequest $request)
    {

        $validated = $request->validated();
        $asset = Assets::where('id', $validated['asset_id'])->select('jenis_id')->first();
        $luas = $validated['panjang'] * $validated['lebar'];
        $tarif = Jenis::where('id', $asset->jenis_id)->first()->tarif * $luas;
        $validated['tarif'] = $tarif;

        try {
            AssetDetail::create($validated);
            Alert::success('Sukses', 'Asset berhasil disimpan');
            return redirect()->route('asset.detail', $validated['asset_id']);
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal menyimpan asset');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AssetDetail $assetDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssetDetail $assetDetail)
    {
        $data['assetDetail'] = $assetDetail;
        return view("assetDetail/edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssetDetailRequest $request, AssetDetail $assetDetail)
    {
        // dd($assetDetail->has('sewaDetail'));
        if ($assetDetail->isUsedInSkrd()) {
            Alert::error('Gagal', 'Tidak dapat mengedit detail asset yang sedang digunakan di Skrd.');
            return redirect()->back();
        }

        try {
            $validated = $request->validated();

            $asset = Assets::where('id', $validated['asset_id'])->select('jenis_id')->first();
            $luas = $validated['panjang'] * $validated['lebar'];
            $tarif = Jenis::where('id', $asset->jenis_id)->first()->tarif * $luas;
            $validated['tarif'] = $tarif;

            $assetDetail->update($validated);

            Alert::success('Sukses', 'Asset berhasil diperbarui');
            return redirect()->route('asset.detail', $validated['asset_id']);
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal memperbarui asset');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssetDetail $assetDetail)
    {
        try {
            $assetDetail->delete();
            Alert::success('Berhasil', 'Asset berhasil dihapus');
        } catch (Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus asset');
        }
        return redirect()->back();
    }
}
