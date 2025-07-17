<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProposalExport;
use Carbon\Carbon;

class ProposalExportController extends Controller
{
    // public function exportFiltered(Request $request)
    // {
    //     $range = $request->range;
    //     $now = Carbon::now();

    //     switch ($range) {
    //         case 'daily':
    //             $from = $now->copy()->startOfDay();
    //             $to = $now->copy()->endOfDay();
    //             break;
    //         case 'weekly':
    //             $from = $now->copy()->startOfWeek();
    //             $to = $now->copy()->endOfWeek();
    //             break;
    //         case 'monthly':
    //             $from = $now->copy()->startOfMonth();
    //             $to = $now->copy()->endOfMonth();
    //             break;
    //         case 'yearly':
    //             $from = $now->copy()->startOfYear();
    //             $to = $now->copy()->endOfYear();
    //             break;
    //         default:
    //             return back()->with('error', 'Range tidak valid.');
    //     }

    //     $proposals = Proposal::whereBetween('created_at', [$from, $to])->get();

    //     if ($proposals->isEmpty()) {
    //         return back()->with('warning', 'Tidak ada data ditemukan.');
    //     }

    //     $fileName = "proposals-{$range}-" . now()->format('Ymd_His') . ".xlsx";
    //     dd($fileName);

    //     return Excel::download(new ProposalExport($proposals), $fileName);

    // }
}
