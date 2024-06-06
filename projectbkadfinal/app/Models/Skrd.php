<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skrd extends Model
{
    protected $fillable = [
        'kode_transaksi',
        'penanggung_jawab_id',
        'denda',
        'pengurangan',
        'terbilang',
        'tanggal_cetak',
    ];

    public function sewa()
    {
        return $this->belongsTo(Sewa::class, 'kode_transaksi', 'kode_transaksi');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'skrd_id', 'id');
    }

    public function penanggungJawab()
    {
        return $this->belongsTo(PenanggungJawab::class, 'penanggung_jawab_id', 'id');
    }
}
