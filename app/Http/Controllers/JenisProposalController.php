<?php

namespace App\Http\Controllers;

use App\Models\JenisProposal;
use Illuminate\Http\Request;

class JenisProposalController extends Controller
{
    public function index()
    {
        $jenisProposals = JenisProposal::all();
        return view('jenis_proposals.index', compact('jenisProposals'));
    }

    public function create()
    {
        return view('jenis_proposals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:jenis_proposals,nama',
        ]);

        JenisProposal::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('jenis-proposals.index')->with('success', 'Jenis Proposal berhasil ditambahkan');
    }

    public function edit(JenisProposal $jenisProposal)
    {
        return view('jenis_proposals.edit', compact('jenisProposal'));
    }

    public function update(Request $request, JenisProposal $jenisProposal)
    {
        $request->validate([
            'nama' => 'required|string|unique:jenis_proposals,nama,' . $jenisProposal->id,
        ]);

        $jenisProposal->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('jenis-proposals.index')->with('success', 'Jenis Proposal berhasil diperbarui');
    }

    public function destroy(JenisProposal $jenisProposal)
    {
        $jenisProposal->delete();

        return redirect()->route('jenis-proposals.index')->with('success', 'Jenis Proposal berhasil dihapus');
    }
}
