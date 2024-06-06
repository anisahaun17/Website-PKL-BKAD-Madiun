<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    protected $table = 'assets';
    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'lokasi', 'jenis_id'];
    public $timestamps = true;

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id', 'id');
    }

    public function sewa()
    {
        return $this->hasMany(Sewa::class, 'asset_id', 'id');
    }

    public function assetDetail()
    {
        return $this->hasMany(AssetDetail::class, 'asset_id', 'id');
    }

    public function isUsedInSkrd()
    {
        return $this->sewa->filter(function ($sewa) {
            return $sewa->skrd && $sewa->skrd->pembayaran !== null;
        })->isNotEmpty();
    }
}
