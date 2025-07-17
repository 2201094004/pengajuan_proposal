<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalEvaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_id',
        'user_id',
        'nilai_status',
        'nilai_pengaruh',
        'nilai_popularitas',
        'nilai_hubungan_perusahaan',
        'nilai_pelaksana',
        'nilai_tujuan',
        'nilai_lokasi',
        'nilai_waktu',
        'nilai_estimasi_dana',
        'nilai_dampak',
        'nilai_partisipasi',
        'nilai_pengaruh_perusahaan',
        'nilai_pencitraan',
        'nilai_referensi',
        'pemberi_rekomendasi',
        'total_score',
        'kesimpulan',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
