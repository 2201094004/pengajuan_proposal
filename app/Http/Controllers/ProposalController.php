<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\JenisProposal; // NEW
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\FilteredProposalsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ProposalController extends Controller
{
    /**
     * Tampilkan daftar proposal milik user yang sedang login.
     */
    public function index()
    {
        $proposals = Proposal::with(['kabupaten', 'kecamatan', 'desa', 'kabupatenTujuan', 'jenisProposal'])
                     ->where('user_id', auth()->id())
                     ->get();

        return view('proposals.index', compact('proposals'));
    }

    /**
     * Form pembuatan proposal baru.
     */
    public function create()
    {
        $kabupatens      = Kabupaten::all();
        $kecamatans      = Kecamatan::all();
        $desas           = Desa::all();
        $jenisProposals  = JenisProposal::all();

        return view('proposals.create', compact('kabupatens', 'kecamatans', 'desas', 'jenisProposals'));
    }

    /**
     * Simpan proposal baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'              => 'required|string|max:255',
            'description'        => 'required|string',
            'document'           => 'nullable|mimes:pdf|max:2048',
            'nama'               => 'required|string|max:255',
            'email'              => 'required|email',
            'no_hp'              => 'required|string|max:20',
            'no_rekening'        => 'required|string|max:50',
            'alamat'             => 'required|string|max:255',
            'kabupaten_id'       => 'required|exists:kabupatens,id',
            'kecamatan_id'       => 'nullable|exists:kecamatans,id',
            'desa_id'            => 'nullable|exists:desas,id',
            'kabupaten_tujuan'   => 'required|string|max:255',
            'jenis_proposal_id'  => 'required|exists:jenis_proposals,id',
        ]);

        $proposal                      = new Proposal();
        $proposal->user_id             = auth()->id();
        $proposal->title               = $request->title;
        $proposal->description         = $request->description;
        $proposal->nama                = $request->nama;
        $proposal->email               = $request->email;
        $proposal->no_hp               = $request->no_hp;
        $proposal->no_rekening         = $request->no_rekening;
        $proposal->alamat              = $request->alamat;
        $proposal->kabupaten_id        = $request->kabupaten_id;
        $proposal->kecamatan_id        = $request->kecamatan_id;
        $proposal->desa_id             = $request->desa_id;
        $proposal->kabupaten_tujuan    = $request->kabupaten_tujuan;
        $proposal->jenis_proposal_id   = $request->jenis_proposal_id;
        $proposal->status              = 'draft';

        // Simpan file
        if ($request->hasFile('document')) {
            $file     = $request->file('document');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('documents', $filename, 'public');
            $proposal->proposal_file = $filename;
        }

        $proposal->save();

        return redirect()->route('proposals.index')->with('success', 'Proposal berhasil dibuat!');
    }

    /**
     * Detail proposal.
     */
    public function show($id)
    {
        $proposal = Proposal::with(['kabupaten', 'kecamatan', 'desa', 'jenisProposal'])
                    ->findOrFail($id);
        if ($proposal->user_id !== auth()->id()) abort(403);

        return view('proposals.show', compact('proposal'));
    }

    /**
     * Form edit proposal.
     */
    public function edit($id)
    {
        $proposal = Proposal::findOrFail($id);
        if ($proposal->user_id !== auth()->id()) abort(403);

        $kabupatens     = Kabupaten::all();
        $kecamatans     = Kecamatan::all();
        $desas          = Desa::all();
        $jenisProposals = JenisProposal::all();

        return view('proposals.edit', compact(
            'proposal',
            'kabupatens',
            'kecamatans',
            'desas',
            'jenisProposals'
        ));
    }

    /**
     * Update proposal.
     */
    public function update(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);
        if ($proposal->user_id !== auth()->id()) abort(403);

        $request->validate([
            'title'              => 'required|string|max:255',
            'description'        => 'required|string',
            'document'           => 'nullable|mimes:pdf|max:2048',
            'nama'               => 'required|string|max:255',
            'email'              => 'required|email',
            'no_hp'              => 'required|string|max:20',
            'no_rekening'        => 'required|string|max:50',
            'alamat'             => 'required|string|max:255',
            'kabupaten_id'       => 'required|exists:kabupatens,id',
            'kecamatan_id'       => 'nullable|exists:kecamatans,id',
            'desa_id'            => 'nullable|exists:desas,id',
            'kabupaten_tujuan'   => 'required|string|max:255',
            'jenis_proposal_id'  => 'required|exists:jenis_proposals,id',
        ]);

        // Mass assignment (pastikan field fillable di model) atau set manual
        $proposal->fill($request->except(['document']));

        // Set yang mungkin tidak ter-fill otomatis
        $proposal->kabupaten_tujuan  = $request->kabupaten_tujuan;
        $proposal->jenis_proposal_id = $request->jenis_proposal_id;

        // Update file
        if ($request->hasFile('document')) {
            if ($proposal->proposal_file && Storage::disk('public')->exists('documents/' . $proposal->proposal_file)) {
                Storage::disk('public')->delete('documents/' . $proposal->proposal_file);
            }

            $file     = $request->file('document');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('documents', $filename, 'public');
            $proposal->proposal_file = $filename;
        }

        $proposal->save();

        return redirect()->route('proposals.index')->with('success', 'Proposal berhasil diperbarui!');
    }

    /**
     * Hapus proposal.
     */
    public function destroy($id)
    {
        $proposal = Proposal::findOrFail($id);
        if ($proposal->user_id !== auth()->id()) abort(403);

        if ($proposal->proposal_file && Storage::disk('public')->exists('documents/' . $proposal->proposal_file)) {
            Storage::disk('public')->delete('documents/' . $proposal->proposal_file);
        }

        $proposal->delete();
        return redirect()->route('proposals.index')->with('success', 'Proposal berhasil dihapus!');
    }

    /**
     * Ajukan proposal (ubah status dari draft ke submitted).
     */
    public function submit($id)
    {
        $proposal = Proposal::findOrFail($id);
        if ($proposal->user_id !== auth()->id()) abort(403);

        if ($proposal->status !== 'draft') {
            return redirect()->route('proposals.index')->with('error', 'Proposal tidak dapat diajukan.');
        }

        $proposal->status = 'submitted';
        $proposal->save();

        return redirect()->route('proposals.index')->with('success', 'Proposal berhasil dikirim!');
    }

    /**
     * Export ke Excel dengan filter waktu.
     */
    public function exportFiltered(Request $request)
    {
        $range = $request->input('range', 'daily');

        $filteredProposals = Proposal::when($range === 'daily', fn($q) => $q->whereDate('created_at', today()))
            ->when($range === 'weekly', fn($q) => $q->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]))
            ->when($range === 'monthly', fn($q) => $q->whereMonth('created_at', now()->month))
            ->when($range === 'yearly', fn($q) => $q->whereYear('created_at', now()->year))
            ->get();

        return Excel::download(new FilteredProposalsExport($filteredProposals), 'data_proposal_' . $range . '.xlsx');
    }

    /**
     * Export ke PDF.
     */
    public function exportPdf(Request $request)
    {
        $range  = $request->input('range', 'daily');
        $search = $request->input('search');

        $query = Proposal::with(['kabupaten', 'kecamatan', 'desa', 'jenisProposal']);

        if ($search) {
            $query->where(fn($q) => $q->where('nama', 'like', "%{$search}%")
                                   ->orWhere('title', 'like', "%{$search}%"));
        }

        if ($request->filled('kabupaten_id')) {
            $query->where('kabupaten_id', $request->kabupaten_id);
        }

        match ($range) {
            'daily'   => $query->whereDate('created_at', today()),
            'weekly'  => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]),
            'monthly' => $query->whereMonth('created_at', now()->month),
            'yearly'  => $query->whereYear('created_at', now()->year),
            default   => null,
        };

        $proposals = $query->get();

        $pdf = Pdf::loadView('exports.proposals_pdf', compact('proposals', 'range'))
                  ->setPaper('A4', 'landscape');

        return $pdf->download('data_proposal_' . $range . '.pdf');
    }
}
