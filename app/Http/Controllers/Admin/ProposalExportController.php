<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proposal;
use Barryvdh\DomPDF\Facade\Pdf;

class ProposalExportController extends Controller
{
    public function exportPdf(Request $request)
    {
        $range = $request->input('range');
        $search = $request->input('search');
        $kabupaten_id = $request->input('kabupaten_id');

        $proposals = Proposal::with(['kabupaten', 'kecamatan', 'desa', 'kabupatenTujuan', 'jenisProposal'])
            ->when($range == 'daily', fn($q) => $q->whereDate('created_at', today()))
            ->when($range == 'weekly', fn($q) => $q->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]))
            ->when($range == 'monthly', fn($q) => $q->whereMonth('created_at', now()->month))
            ->when($range == 'yearly', fn($q) => $q->whereYear('created_at', now()->year))
            ->when($kabupaten_id, fn($q) => $q->where('kabupaten_id', $kabupaten_id))
            ->when($search, fn($q) => $q->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('title', 'like', "%$search%");
            }))
            ->get();

        $pdf = Pdf::loadView('exports.proposals_pdf', compact('proposals'))->setPaper('a4', 'landscape');

        return $pdf->download('data_proposal.pdf');
    }
}
