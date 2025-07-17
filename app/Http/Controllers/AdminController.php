<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FilteredProposalsExport;

class AdminController extends Controller
{
    // Dashboard Admin
    public function dashboard()
    {
        // Hitung jumlah proposal berdasarkan status
        $totalDiterima = Proposal::where('status', 'accepted')->count();
        $totalDitolak = Proposal::where('status', 'rejected')->count();
        $totalRevisi = Proposal::where('status', 'revised')->count();

        // Ambil jumlah proposal per kabupaten
        $dataPerKabupaten = Proposal::select('kabupaten_id', DB::raw('count(*) as total'))
            ->groupBy('kabupaten_id')
            ->with('kabupaten')
            ->get();

        $labelsKabupaten = $dataPerKabupaten->pluck('kabupaten.nama')->toArray();
        $jumlahProposalPerKabupaten = $dataPerKabupaten->pluck('total')->toArray();

        return view('admin.dashboard', compact(
            'totalDiterima',
            'totalDitolak',
            'totalRevisi',
            'labelsKabupaten',
            'jumlahProposalPerKabupaten'
        ));
    }

    // Menampilkan daftar proposal dengan pencarian
    public function statusPengajuan(Request $request)
    {
        $query = Proposal::query()->with(['kabupaten', 'kecamatan', 'desa']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%");
            });
        }

        $proposals = $query->latest()->get();

        return view('admin.status-pengajuan', compact('proposals'));
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
}
