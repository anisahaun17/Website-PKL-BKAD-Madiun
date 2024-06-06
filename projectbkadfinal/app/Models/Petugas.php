<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id';
    protected $fillable = ['nama'];
    public $timestamps = true;

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'petugas_id', 'id');
    }
}
