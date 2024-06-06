<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    protected $primaryKey = 'kode_transaksi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_transaksi', 'asset_id', 'nama', 'nik', 'telepon', 'npwr', 'alamat', 'tgl_sewa_mulai', 'lama_sewa'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->kode_transaksi = Str::uuid();
        });
    }

    public function asset()
    {
        return $this->belongsTo(Assets::class, 'asset_id', 'id');
    }

    public function sewaDetail()
    {
        return $this->hasMany(SewaDetail::class, 'kode_transaksi', 'kode_transaksi');
    }

    public function skrd()
    {
        return $this->hasOne(Skrd::class, 'kode_transaksi', 'kode_transaksi');
    }
}
