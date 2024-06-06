<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatans';
    protected $primaryKey = 'id';
    protected $fillable = ['nama'];
    public $timestamps = true;

    public function penanggungJawab()
    {
        return $this->hasMany(PenanggungJawab::class, 'jabatan_id', 'id');
    }
}
