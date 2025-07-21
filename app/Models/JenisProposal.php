<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisProposal extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

}
