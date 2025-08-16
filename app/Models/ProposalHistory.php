<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProposalHistory extends Model
{
    protected $fillable = ['proposal_id', 'user_id', 'action', 'note'];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

