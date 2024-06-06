<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayarans';
    protected $primaryKey = 'id';
    protected $fillable = ['skrd_id', 'petugas_id', 'total', 'tanggal_pembayaran'];
    public $timestamps = true;

    public function skrd()
    {
        return $this->belongsTo(Skrd::class, 'skrd_id', 'id');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id', 'id');
    }
}
