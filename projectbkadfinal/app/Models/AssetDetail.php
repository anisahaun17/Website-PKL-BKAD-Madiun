<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetDetail extends Model
{
    protected $table = 'asset_details';
    protected $primaryKey = 'id';
    protected $fillable = ['asset_id', 'panjang', 'lebar', 'tarif', 'jumlah_asset', 'jumlah_digunakan'];
    public $timestamps = true;

    public function asset()
    {
        return $this->belongsTo(Assets::class, 'asset_id', 'id');
    }

    public function sewaDetail()
    {
        return $this->hasMany(SewaDetail::class, 'asset_detail_id', 'id');
    }

    public function isUsedInSkrd()
    {
        return $this->asset->sewa->filter(function ($sewa) {
            return $sewa->skrd && $sewa->skrd->pembayaran !== null;
        })->isNotEmpty();
    }
}
