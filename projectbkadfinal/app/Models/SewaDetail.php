<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SewaDetail extends Model
{
    protected $fillable = [
        'kode_transaksi', 'asset_detail_id', 'jumlah', 'tarif', 'harga'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($sewaDetail) {
            $sewaDetail->updateAssetDetailJumlahDigunakan(true);
        });

        static::deleted(function ($sewaDetail) {
            $sewaDetail->updateAssetDetailJumlahDigunakan(false);
        });
    }

    // Helper method to update jumlah_digunakan in AssetDetail
    public function updateAssetDetailJumlahDigunakan($isAdding)
    {
        $amount = $isAdding ? $this->jumlah : -$this->jumlah;

        $assetDetail = AssetDetail::find($this->asset_detail_id);

        if ($assetDetail) {
            $assetDetail->jumlah_digunakan += $amount;
            $assetDetail->save();
        }
    }

    public function sewa()
    {
        return $this->belongsTo(Sewa::class, 'kode_transaksi', 'kode_transaksi');
    }

    public function assetDetail()
    {
        return $this->belongsTo(AssetDetail::class, 'asset_detail_id', 'id');
    }
}
