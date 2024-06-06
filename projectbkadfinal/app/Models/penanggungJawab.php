<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class penanggungJawab extends Model
{
    protected $table = 'penanggung_jawabs';
    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'nip', 'jabatan_id', 'status'];
    public $timestamps = true;

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }

    public function skrd()
    {
        return $this->hasMany(Skrd::class, 'penanggung_jawab_id', 'id');
    }
}
