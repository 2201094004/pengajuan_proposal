<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FilteredProposalsExport implements FromView
{
    protected $proposals;

    public function __construct($proposals)
    {
        $this->proposals = $proposals;
    }

    public function view(): View
    {
        return view('exports.proposals_excel', [
            'proposals' => $this->proposals
        ]);
    }
}
