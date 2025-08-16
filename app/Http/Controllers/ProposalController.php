<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\JenisProposal;
use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Storage;
use App\Exports\FilteredProposalsExport;
use Maatwebsite\Excel\Facades\Excel;


use Barryvdh\DomPDF\Facade\Pdf;

class ProposalController extends Controller
{
    public function index()
    {
        $proposals = Proposal::with(['kabupaten', 'kecamatan', 'desa', 'kabupatenTujuan', 'jenisProposal'])
                     ->where('user_id', auth()->id())
                     ->get();

        $proposals = Proposal::paginate(5);
        return view('proposals.index', compact('proposals'));
    }

    public function create()
    {
        $kabupatens     = Kabupaten::all();
        $kecamatans     = Kecamatan::all();
        $desas          = Desa::all();
        $jenisProposals = JenisProposal::all();

        return view('proposals.create', compact('kabupatens', 'kecamatans', 'desas', 'jenisProposals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'               => 'required|string|max:255',
            'description'         => 'required|string',
            'document'            => 'nullable|mimes:pdf|max:2048',
            'nama'                => 'required|string|max:255',
            'email'               => 'required|email',
            'no_hp'               => 'required|string|max:20',
            'no_rekening'         => 'required|string|max:50',
            'alamat'              => 'required|string|max:255',
            'kabupaten_id'        => 'required|exists:kabupatens,id',
            'kecamatan_id'        => 'nullable|exists:kecamatans,id',
            'desa_id'             => 'nullable|exists:desas,id',
            'kabupaten_tujuan_id' => 'required|exists:kabupatens,id',
            'jenis_proposal_id'   => 'required|exists:jenis_proposals,id',
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
        $proposal->kabupaten_tujuan_id = $request->kabupaten_tujuan_id;
        $proposal->jenis_proposal_id   = $request->jenis_proposal_id;
        $proposal->status              = 'draft';

        if ($request->hasFile('document')) {
            $file     = $request->file('document');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('documents', $filename, 'public');
            $proposal->proposal_file = $filename;
        }

        $proposal->save();

        return redirect()->route('proposals.index')->with('success', 'Proposal berhasil dibuat!');
    }

    public function show($id)
    {
        $proposal = Proposal::with(['kabupaten', 'kecamatan', 'desa', 'kabupatenTujuan', 'jenisProposal'])->findOrFail($id);
        if ($proposal->user_id !== auth()->id()) abort(403);

        return view('proposals.show', compact('proposal'));
    }

    public function edit($id)
    {
        $proposal = Proposal::findOrFail($id);
        if ($proposal->user_id !== auth()->id()) abort(403);

        $kabupatens     = Kabupaten::all();
        $kecamatans     = Kecamatan::all();
        $desas          = Desa::all();
        $jenisProposals = JenisProposal::all();

        return view('proposals.edit', compact('proposal', 'kabupatens', 'kecamatans', 'desas', 'jenisProposals'));
    }

    public function update(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);
        if ($proposal->user_id !== auth()->id()) abort(403);

        $request->validate([
            'title'               => 'required|string|max:255',
            'description'         => 'required|string',
            'document'            => 'nullable|mimes:pdf|max:2048',
            'nama'                => 'required|string|max:255',
            'email'               => 'required|email',
            'no_hp'               => 'required|string|max:20',
            'no_rekening'         => 'required|string|max:50',
            'alamat'              => 'required|string|max:255',
            'kabupaten_id'        => 'required|exists:kabupatens,id',
            'kecamatan_id'        => 'nullable|exists:kecamatans,id',
            'desa_id'             => 'nullable|exists:desas,id',
            'kabupaten_tujuan_id' => 'required|exists:kabupatens,id',
            'jenis_proposal_id'   => 'required|exists:jenis_proposals,id',
        ]);

        $proposal->fill($request->except('document'));

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

    public function exportFilteredExcel(Request $request)
    {
     $proposals = Proposal::with('kabupaten')->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header kolom
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Judul');
        $sheet->setCellValue('D1', 'Kabupaten');
        $sheet->setCellValue('E1', 'Tanggal Diajukan');

        $range  = $request->input('range', 'daily');
        $search = $request->input('search');

        $query = Proposal::with(['kabupaten', 'kecamatan', 'desa', 'kabupatenTujuan', 'jenisProposal']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                ->orWhere('title', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kabupaten_id')) {
            $query->where('kabupaten_id', $request->kabupaten_id);
        }

          $row = 2;
    foreach ($proposals as $proposal) {
        $sheet->setCellValue('A' . $row, $proposal->id);
        $sheet->setCellValue('B' . $row, $proposal->nama);
        $sheet->setCellValue('C' . $row, $proposal->title);
        $sheet->setCellValue('D' . $row, $proposal->kabupaten->nama ?? '-');
        $sheet->setCellValue('E' . $row, $proposal->created_at->format('Y-m-d'));
        $row++;
    }

        $filteredProposals = $query->get();

        return Excel::download(new FilteredProposalsExport($filteredProposals), 'data_proposal_' . $range . '.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $proposals = Proposal::with(['kabupaten'])->get();

        $pdf = Pdf::loadView('exports.proposals_pdf', compact('proposals'))
                ->setPaper('A4', 'landscape');

        return $pdf->download('data_proposal.pdf');
    }

    public function penilaian($id)
    {
        $proposal = Proposal::findOrFail($id);
        return view('proposals.penilaian', compact('proposal'));
    }

    public function updatePenilaian(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected,revised',
            'catatan' => 'nullable|string'
        ]);

        $proposal = Proposal::findOrFail($id);
        $proposal->status = $request->status;
        $proposal->catatan = $request->catatan;
        $proposal->save();

        return redirect()->route('admin.status-pengajuan')->with('success', 'Penilaian berhasil disimpan.');
    }

    
}
