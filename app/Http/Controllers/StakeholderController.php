<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\ProposalEvaluation;
use App\Models\User;
use App\Models\StatusHistory;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StakeholderController extends Controller
{
    public function dashboard()
    {
        $proposals = Proposal::where('status', 'submitted')->get();
        return view('stakeholder.dashboard', compact('proposals'));
    }

    public function evaluateForm($id)
    {
        $proposal = Proposal::findOrFail($id);
        return view('stakeholder.evaluate', compact('proposal'));
    }

    public function evaluateList()
    {
        $proposals = Proposal::where('status', 'submitted')->get(); // Atau sesuaikan logika
        return view('stakeholder.evaluate-list', compact('proposals'));
    }

    public function history()
    {
        $evaluations = auth()->user()
            ->proposalevaluations()
            ->with('proposal')
            ->latest()
            ->get();

        return view('stakeholder.history', compact('evaluations'));
    }

    public function evaluateStore(Request $request, $id)
    {
        $request->validate([
            'nilai_status' => 'required|integer',
            'nilai_pengaruh' => 'required|integer',
            'nilai_popularitas' => 'required|integer',
            'nilai_hubungan_perusahaan' => 'required|integer',
            'nilai_pelaksana' => 'required|integer',
            'nilai_tujuan' => 'required|integer',
            'nilai_lokasi' => 'required|integer',
            'nilai_waktu' => 'required|integer',
            'nilai_estimasi_dana' => 'required|integer',
            'nilai_dampak' => 'required|integer',
            'nilai_partisipasi' => 'required|integer',
            'nilai_pengaruh_perusahaan' => 'required|integer',
            'nilai_pencitraan' => 'required|integer',
            'nilai_referensi' => 'required|integer',
            'pemberi_rekomendasi' => 'required|string|max:255',
            'kesimpulan' => 'required|in:dibantu,tidak dibantu',
            'catatan' => 'nullable|string',
        ]);

        $totalScore = collect($request->only([
            'nilai_status',
            'nilai_pengaruh',
            'nilai_popularitas',
            'nilai_hubungan_perusahaan',
            'nilai_pelaksana',
            'nilai_tujuan',
            'nilai_lokasi',
            'nilai_waktu',
            'nilai_estimasi_dana',
            'nilai_dampak',
            'nilai_partisipasi',
            'nilai_pengaruh_perusahaan',
            'nilai_pencitraan',
            'nilai_referensi'
        ]))->sum();

        ProposalEvaluation::create([
            'proposal_id' => $id,
            'user_id' => Auth::id(),
            'nilai_status' => $request->nilai_status,
            'nilai_pengaruh' => $request->nilai_pengaruh,
            'nilai_popularitas' => $request->nilai_popularitas,
            'nilai_hubungan_perusahaan' => $request->nilai_hubungan_perusahaan,
            'nilai_pelaksana' => $request->nilai_pelaksana,
            'nilai_tujuan' => $request->nilai_tujuan,
            'nilai_lokasi' => $request->nilai_lokasi,
            'nilai_waktu' => $request->nilai_waktu,
            'nilai_estimasi_dana' => $request->nilai_estimasi_dana,
            'nilai_dampak' => $request->nilai_dampak,
            'nilai_partisipasi' => $request->nilai_partisipasi,
            'nilai_pengaruh_perusahaan' => $request->nilai_pengaruh_perusahaan,
            'nilai_pencitraan' => $request->nilai_pencitraan,
            'nilai_referensi' => $request->nilai_referensi,
            'pemberi_rekomendasi' => $request->pemberi_rekomendasi,
            'total_score' => $totalScore,
            'kesimpulan' => $request->kesimpulan,
            'catatan' => $request->catatan,
        ]);

        // Update status proposal jadi accepted/rejected tergantung kesimpulan
        $proposal = Proposal::findOrFail($id);
        $proposal->status = $request->kesimpulan === 'dibantu' ? 'accepted' : 'rejected';
        $proposal->save();

        // Catat ke status history
        StatusHistory::create([
            'proposal_id' => $id,
            'user_id' => Auth::id(),
            'status' => $proposal->status,
            'catatan' => $request->catatan,
        ]);

        // Catat ke log aktivitas
        LogActivity::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Evaluasi Proposal',
            'keterangan' => 'Melakukan evaluasi terhadap proposal #' . $proposal->id,
        ]);

        return redirect()->route('stakeholder.dashboard')->with('success', 'Evaluasi berhasil disimpan.');
    }
}
