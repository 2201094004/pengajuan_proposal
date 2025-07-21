<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Kabupaten;
use App\Models\JenisProposal;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Halaman Dashboard Admin
   public function admin()
    {
        // Ringkasan
        $totalDiterima = Proposal::where('status', 'accepted')->count();
        $totalDitolak  = Proposal::where('status', 'rejected')->count();
        $totalRevisi   = Proposal::where('status', 'revised')->count();

        // Diagram Batang: Kabupaten
        $kabupatens = Kabupaten::all();
        $labelsKabupaten = [];
        $jumlahProposalPerKabupaten = [];

        foreach ($kabupatens as $kab) {
            $labelsKabupaten[] = $kab->nama;
            $jumlahProposalPerKabupaten[] = Proposal::where('kabupaten_id', $kab->id)->count();
        }

        // Diagram Pie: Jenis Proposal
        $jenisList = JenisProposal::all();
        $labelsJenisProposal = [];
        $jumlahPerJenisProposal = [];

        foreach ($jenisList as $jenis) {
            $labelsJenisProposal[] = $jenis->nama;
            $jumlahPerJenisProposal[] = Proposal::where('jenis_proposal_id', $jenis->id)->count();
        }

        // Kirim ke view
        return view('admin.dashboard', compact(
            'totalDiterima',
            'totalDitolak',
            'totalRevisi',
            'labelsKabupaten',
            'jumlahProposalPerKabupaten',
            'labelsJenisProposal',
            'jumlahPerJenisProposal'
        ));
    }

    // Halaman Dashboard Masyarakat
    public function masyarakat()
    {
        return view('masyarakat.dashboard');
    }

    // Halaman Dashboard Stakeholder
    public function stakeholder()
    {
        return view('stakeholder.dashboard');
    }
}
