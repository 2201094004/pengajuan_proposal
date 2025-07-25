<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kabupaten;
use App\Models\Kecamatan;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'title',
        'description',
        'email',
        'no_hp',
        'no_rekening',
        'alamat',
        'jenis_proposal',
        'kabupaten_id',
        'kecamatan_id',
        'desa_id',
        'kabupaten_tujuan_id',
        'proposal_file',
        'form_penilaian_auto',
        'status',
    ];

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kabupatenTujuan()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_tujuan_id');
    }

    public function jenisProposal()
    {
        return $this->belongsTo(JenisProposal::class, 'jenis_proposal_id');
    }

    // public function evaluations()
    // {
    //     return $this->hasMany(ProposalEvaluation::class);
    // }

    // public function jenisProposal()
    // {
    //     return $this->belongsTo(JenisProposal::class);
    // }

}
