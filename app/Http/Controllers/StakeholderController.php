<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Proposal;
use App\Models\Kabupaten;
use App\Models\JenisProposal;

class StakeholderController extends Controller
{
    public function dashboard()
    {
        // Status statistik
        $totalDiterima = Proposal::where('status', 'accepted')->count();
        $totalDitolak  = Proposal::where('status', 'rejected')->count();
        $totalRevisi   = Proposal::where('status', 'revised')->count();

        // Statistik per Kabupaten
        $dataPerKabupaten = Proposal::select('kabupaten_id', DB::raw('count(*) as total'))
            ->groupBy('kabupaten_id')
            ->with('kabupaten') // relasi harus ada di model Proposal
            ->get();

        $labelsKabupaten = $dataPerKabupaten->pluck('kabupaten.nama')->toArray();
        $jumlahProposalPerKabupaten = $dataPerKabupaten->pluck('total')->toArray();

        // Statistik per Jenis Proposal
        $dataPerJenisProposal = Proposal::select('jenis_proposal_id', DB::raw('count(*) as total'))
            ->groupBy('jenis_proposal_id')
            ->with('jenisProposal') // relasi harus ada di model Proposal
            ->get();

        $labelsJenisProposal = $dataPerJenisProposal->pluck('jenisProposal.nama')->toArray();
        $jumlahPerJenisProposal = $dataPerJenisProposal->pluck('total')->toArray();

        return view('stakeholder.dashboard', compact(
            'totalDiterima',
            'totalDitolak',
            'totalRevisi',
            'labelsKabupaten',
            'jumlahProposalPerKabupaten',
            'labelsJenisProposal',
            'jumlahPerJenisProposal'
        ));
    }

    public function statusPengajuan(Request $request)
    {
        $query = Proposal::query();

        // Filter kabupaten
        if ($request->filled('kabupaten_id')) {
            $query->where('kabupaten_id', $request->kabupaten_id);
        }

        // Filter rentang waktu
        if ($request->filled(['start_date', 'end_date'])) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $proposals = $query->get();
        $kabupatens = Kabupaten::all();

        return view('admin.status-pengajuan', compact('proposals', 'kabupatens'));
    }

    public function semuaProposal()
    {
        $proposals = Proposal::with(['kabupaten', 'jenisProposal'])->latest()->get();
        return view('proposals.index', compact('proposals'));
    }

}
