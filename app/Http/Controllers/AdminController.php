<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\User;
use App\Models\Kabupaten;
use App\Models\ProposalHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FilteredProposalsExport;

class AdminController extends Controller
{
    // Dashboard Admin
    public function dashboard()
    {
        // Status statistik
        $totalDiterima = Proposal::where('status', 'accepted')->count();
        $totalDitolak  = Proposal::where('status', 'rejected')->count();
        $totalRevisi   = Proposal::where('status', 'revised')->count();

        // Per Kabupaten
        $dataPerKabupaten = Proposal::select('kabupaten_id', DB::raw('count(*) as total'))
            ->groupBy('kabupaten_id')
            ->with('kabupaten') // Pastikan relasi 'kabupaten' ada
            ->get();

        $labelsKabupaten = $dataPerKabupaten->pluck('kabupaten.nama')->toArray();
        $jumlahProposalPerKabupaten = $dataPerKabupaten->pluck('total')->toArray();

        // Per Jenis Proposal
        $labelsJenisProposal = Proposal::select('jenis_proposal')->distinct()->pluck('jenis_proposal')->toArray();

        $jumlahPerJenisProposal = [];
        foreach ($labelsJenisProposal as $jenis) {
            $jumlahPerJenisProposal[] = Proposal::where('jenis_proposal', $jenis)->count();
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

    // Menampilkan daftar proposal dengan pencarian
    public function statusPengajuan(Request $request)
    {
        // Query dasar dengan relasi
        $query = Proposal::with(['kabupaten', 'kecamatan', 'desa', 'kabupatenTujuan', 'jenisProposal']);

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                ->orWhere('title', 'like', "%{$search}%");
            });
        }

        // Filter kabupaten
        if ($request->filled('kabupaten_id')) {
            $query->where('kabupaten_id', $request->kabupaten_id);
        }

        // Filter range waktu
        if ($request->filled('range')) {
            match ($request->range) {
                'daily'   => $query->whereDate('created_at', today()),
                'weekly'  => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]),
                'monthly' => $query->whereMonth('created_at', now()->month),
                'yearly'  => $query->whereYear('created_at', now()->year),
                default   => null,
            };
        }

        // Ambil data dengan pagination
        $proposals = $query->paginate(5);

        // Ambil data kabupaten untuk filter dropdown
        $kabupatens = Kabupaten::orderBy('nama')->get();

        // Kirim data ke view
        return view('admin.status-pengajuan', compact('proposals', 'kabupatens'));
    }

    // Menerima proposal
    public function acceptProposal($id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->status = 'accepted';
        $proposal->save();

        return redirect()->route('admin.status-pengajuan')->with('success', 'Proposal berhasil diterima.');
    }

    // Menolak proposal
    public function rejectProposal($id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->status = 'rejected';
        $proposal->save();

        return redirect()->route('admin.status-pengajuan')->with('success', 'Proposal berhasil ditolak.');
    }

    // Memberi status revisi proposal
    public function revisionProposal($id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->status = 'revised';
        $proposal->save();

        return redirect()->route('admin.status-pengajuan')->with('success', 'Proposal ditandai untuk revisi.');
    }

    // Menampilkan daftar user
    public function manageUsers()
    {
        $users = User::all();
        $users = User::paginate(5);
        return view('admin.manage-users', compact('users'));
    }

    // Form tambah user
    public function createUser()
    {
        return view('admin.create-user');
    }

    // Simpan user baru
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,masyarakat,stakeholder',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.manage-users')->with('success', 'User berhasil ditambahkan.');
    }

    // Form edit user
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    // Update data user
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,masyarakat,stakeholder',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.manage-users')->with('success', 'User berhasil diperbarui.');
    }

    // Hapus user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.manage-users')->with('success', 'User berhasil dihapus.');
    }

    // Ekspor data proposal berdasarkan range waktu
    public function exportProposals(Request $request)
    {
        $range = $request->input('range');

        $filteredProposals = Proposal::with(['kabupaten', 'kecamatan', 'desa'])
            ->when($range == 'daily', function ($q) {
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

    public function accept($id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->status = 'accepted';
        $proposal->verified_by = auth()->id();
        $proposal->save();

        return back()->with('success', 'Proposal diterima.');
    }

    public function reject($id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->status = 'rejected';
        $proposal->verified_by = auth()->id();
        $proposal->save();

        return back()->with('success', 'Proposal ditolak.');
    }

    public function revision($id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->status = 'revised';
        $proposal->verified_by = auth()->id();
        $proposal->save();

        return back()->with('success', 'Proposal dikembalikan untuk revisi.');
    }

    public function history($id)
    {
        $proposal = Proposal::with('histories.user')->findOrFail($id);
        return view('admin.proposals.history', compact('proposal'));
    }

    public function updateStatus(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->status = $request->status;   // Diterima / Ditolak / Revisi
        $proposal->verifier_id = auth()->id();  // simpan user login yang verifikasi
        $proposal->save();

        return back()->with('success', 'Status berhasil diperbarui');
    }

}