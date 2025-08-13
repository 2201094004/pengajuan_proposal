<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $fillable = [
        'nama',
        'kecamatan_id',
    ];

    // Relasi ke Proposal
    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'desa_id');
    }

    // Relasi ke Kecamatan
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}

