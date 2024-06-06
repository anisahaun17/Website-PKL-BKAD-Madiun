<?php

namespace App\Http\Controllers;

use App\Models\AssetDetail;
use App\Models\Assets;
use App\Models\Jenis;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function jenisByKategori($kategori_id)
    {
        $jenis = Jenis::select('id', 'nama')->where('kategori_id', $kategori_id)->get();
        return response()->json($jenis);
    }

    public function assetByJenis($jenis_id)
    {
        $asset = Assets::select('id', 'nama')->where('jenis_id', $jenis_id)->get();
        return response()->json($asset);
    }

    public function assetDetailByJenis($asset_id)
    {
        $asset = AssetDetail::select('id', 'panjang', 'lebar', 'luas', 'tarif', 'jumlah_tersedia')->where('asset_id', $asset_id)->get();
        return response()->json($asset);
    }

    public function assetDetailById(AssetDetail $assetDetail)
    {
        $selectedColumns = [
            'panjang',
            'lebar',
            'luas',
            'tarif',
            'jumlah_tersedia',
        ];

        $selectedData = $assetDetail->only($selectedColumns);
        return response()->json($selectedData);
    }
}
