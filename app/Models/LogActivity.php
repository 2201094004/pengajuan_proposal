<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'aktivitas',
        'keterangan',
    ];

    /**
     * Relasi ke user yang melakukan aktivitas
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
