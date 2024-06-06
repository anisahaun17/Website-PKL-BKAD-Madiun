<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = 'jenis';
    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'tarif', 'kategori_id'];
    public $timestamps = true;

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function assets()
    {
        return $this->hasMany(Assets::class);
    }
}
