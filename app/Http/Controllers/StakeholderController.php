<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Proposal;
use App\Models\Kabupaten;

class StakeholderController extends Controller
{
    // Dashboard Stakeholder
    public function dashboard()
    {
        // Statistik status
        $totalDiterima = Proposal::where('status', 'accepted')->count();
        $totalDitolak  = Proposal::where('status', 'rejected')->count();
        $totalRevisi   = Proposal::where('status', 'revised')->count();

        // Statistik per Kabupaten
        $dataPerKabupaten = Proposal::select('kabupaten_id', DB::raw('count(*) as total'))
            ->groupBy('kabupaten_id')
            ->with('kabupaten')
            ->get();

        $labelsKabupaten = $dataPerKabupaten->pluck('kabupaten.nama')->toArray();
        $jumlahProposalPerKabupaten = $dataPerKabupaten->pluck('total')->toArray();

        // Statistik per Jenis Proposal
        $dataPerJenisProposal = Proposal::select('jenis_proposal_id', DB::raw('count(*) as total'))
            ->groupBy('jenis_proposal_id')
            ->with('jenisProposal')
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

    // Daftar status pengajuan (versi Stakeholder)
    public function statusPengajuan(Request $request)
    {
        $query = Proposal::with(['kabupaten', 'kecamatan', 'desa', 'kabupatenTujuan', 'jenisProposal']);

        // Filter kabupaten
        if ($request->filled('kabupaten_id')) {
            $query->where('kabupaten_id', $request->kabupaten_id);
        }

        // Filter range tanggal
        if ($request->filled(['start_date', 'end_date'])) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // Pagination biar konsisten
        $proposals = $query->paginate(5);
        $kabupatens = Kabupaten::orderBy('nama')->get();

        return view('admin.status-pengajuan', compact('proposals', 'kabupatens'));
    }

    // Semua proposal (untuk daftar umum)
    public function semuaProposal()
    {
        $proposals = Proposal::with(['kabupaten', 'jenisProposal'])->latest()->paginate(10);
        return view('proposals.index', compact('proposals'));
    }
}
