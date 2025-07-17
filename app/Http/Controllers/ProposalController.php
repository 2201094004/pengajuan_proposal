<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\FilteredProposalsExport;
use Maatwebsite\Excel\Facades\Excel;

class ProposalController extends Controller
{
    public function index()
    {
        $proposals = Proposal::with(['kabupaten', 'kecamatan', 'desa', 'kabupatenTujuan'])
                     ->where('user_id', auth()->id())
                     ->get();

        return view('proposals.index', compact('proposals'));
    }

    public function create()
    {
        $kabupatens = Kabupaten::all();
        $kecamatans = Kecamatan::all();
        $desas = Desa::all();
        return view('proposals.create', compact('kabupatens', 'kecamatans', 'desas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'document' => 'nullable|mimes:pdf|max:2048',
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|string|max:20',
            'no_rekening' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
            'kabupaten_id' => 'required|exists:kabupatens,id',
            'kecamatan_id' => 'nullable|exists:kecamatans,id',
            'desa_id' => 'nullable|exists:desas,id',
            'kabupaten_tujuan' => 'required|string|max:255',
        ]);

        $proposal = new Proposal();
        $proposal->user_id = auth()->id();
        $proposal->title = $request->title;
        $proposal->description = $request->description;
        $proposal->nama = $request->nama;
        $proposal->email = $request->email;
        $proposal->no_hp = $request->no_hp;
        $proposal->no_rekening = $request->no_rekening;
        $proposal->alamat = $request->alamat;
        $proposal->kabupaten_id = $request->kabupaten_id;
        $proposal->kecamatan_id = $request->kecamatan_id;
        $proposal->desa_id = $request->desa_id;
        // $proposal->kabupaten_tujuan = $request->kabupaten_tujuan;
        $proposal->status = 'draft';

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('documents', $filename, 'public');
            $proposal->proposal_file = $filename;
        }

        $proposal->save();

        return redirect()->route('proposals.index')->with('success', 'Proposal berhasil dibuat!');
    }

    public function show($id)
    {
        $proposal = Proposal::with(['kabupaten', 'kecamatan', 'desa'])->findOrFail($id);
        if ($proposal->user_id !== auth()->id()) abort(403);

        return view('proposals.show', compact('proposal'));
    }

    public function edit($id)
    {
        $proposal = Proposal::findOrFail($id);
        if ($proposal->user_id !== auth()->id()) abort(403);

        $kabupatens = Kabupaten::all();
        $kecamatans = Kecamatan::all();
        $desas = Desa::all();

        return view('proposals.edit', compact('proposal', 'kabupatens', 'kecamatans', 'desas'));
    }

    public function update(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);
        if ($proposal->user_id !== auth()->id()) abort(403);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'document' => 'nullable|mimes:pdf|max:2048',
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|string|max:20',
            'no_rekening' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
            'kabupaten_id' => 'required|exists:kabupatens,id',
            'kecamatan_id' => 'nullable|exists:kecamatans,id',
            'desa_id' => 'nullable|exists:desas,id',
            // 'kabupaten_tujuan' => 'required|string|max:255',
        ]);

        $proposal->fill($request->except('document'));

        if ($request->hasFile('document')) {
            if ($proposal->proposal_file && Storage::disk('public')->exists('documents/' . $proposal->proposal_file)) {
                Storage::disk('public')->delete('documents/' . $proposal->proposal_file);
            }

            $file = $request->file('document');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('documents', $filename, 'public');
            $proposal->proposal_file = $filename;
        }

        $proposal->save();

        return redirect()->route('proposals.index')->with('success', 'Proposal berhasil diperbarui!');
    }

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

    public function exportFiltered(Request $request)
    {
        $range = $request->input('range');

        $filteredProposals = Proposal::when($range == 'daily', function ($q) {
            $q->whereDate('created_at', today());
        })->when($range == 'weekly', function ($q) {
            $q->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        })->when($range == 'monthly', function ($q) {
            $q->whereMonth('created_at', now()->month);
        })->when($range == 'yearly', function ($q) {
            $q->whereYear('created_at', now()->year);
        })->get();

        return Excel::download(new FilteredProposalsExport($filteredProposals), 'data_proposal_' . $range . '.xlsx');
    }
}
