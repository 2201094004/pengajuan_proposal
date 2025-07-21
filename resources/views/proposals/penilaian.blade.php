@extends('layouts.app')

@section('content')
<div class="container bg-white p-4" id="print-area">
    <h4 class="text-center mb-4">LEMBAR PENILAIAN PROPOSAL DONASI</h4>

    <p><strong>Tanggal Terima Proposal:</strong> {{ $proposal->created_at->format('d-m-Y') }}</p>
    <p><strong>Diterima Oleh:</strong> {{ auth()->user()->name }}</p>
    <hr>

    <h5>I. PEMOHON (20%)</h5>
    <ul>
        <li><strong>Nama Pemohon:</strong> {{ $proposal->nama }}</li>
        <li><strong>Status:</strong> {{ $proposal->status_pemohon ?? '-' }}</li>
        <li><strong>Tingkat Pengaruh:</strong> {{ $proposal->tingkat_pengaruh ?? '-' }}</li>
        <li><strong>Alamat:</strong> {{ $proposal->alamat }}</li>
        <li><strong>No HP:</strong> {{ $proposal->phone }}</li>
        <li><strong>No Rekening:</strong> {{ $proposal->rekening }}</li>
        <li><strong>Email:</strong> {{ $proposal->email }}</li>
        <li><strong>Popularitas:</strong> {{ $proposal->popularitas ?? '-' }}</li>
        <li><strong>Hubungan Perusahaan:</strong> {{ $proposal->hubungan_perusahaan ?? '-' }}</li>
        <li><strong>Score I:</strong> {{ $proposal->score_i ?? 0 }}</li>
    </ul>

    <h5>II. KEGIATAN (30%)</h5>
    <ul>
        <li><strong>Jadwal:</strong> {{ $proposal->jadwal }}</li>
        <li><strong>Tempat:</strong> {{ $proposal->tempat }}</li>
        <li><strong>Pelaksana:</strong> {{ $proposal->pelaksana }}</li>
        <li><strong>Tujuan:</strong> {{ $proposal->tujuan_kegiatan }}</li>
        <li><strong>Lokasi Kegiatan:</strong> {{ $proposal->lokasi_kegiatan }}</li>
        <li><strong>Waktu Pelaksanaan:</strong> {{ $proposal->jangka_waktu }}</li>
        <li><strong>Estimasi Dana:</strong> Rp {{ number_format($proposal->estimasi_dana) }}</li>
        <li><strong>Score II:</strong> {{ $proposal->score_ii ?? 0 }}</li>
    </ul>

    <h5>III. MANFAAT BAGI PERUSAHAAN (50%)</h5>
    <ul>
        <li><strong>Dampak:</strong> {{ $proposal->dampak_kegiatan }}</li>
        <li><strong>Partisipasi:</strong> {{ $proposal->partisipasi }}</li>
        <li><strong>Pengaruh Hubungan:</strong> {{ $proposal->pengaruh_hubungan }}</li>
        <li><strong>Pencitraan:</strong> {{ $proposal->pencitraan }}</li>
        <li><strong>Logo Perusahaan:</strong> {{ $proposal->logo_perusahaan ? 'Ada' : 'Tidak Ada' }}</li>
        <li><strong>Score III:</strong> {{ $proposal->score_iii ?? 0 }}</li>
    </ul>

    <h5>IV. REFERENSI (Nilai Tambah)</h5>
    <ul>
        <li><strong>Rekomendasi:</strong> {{ $proposal->pemberi_rekomendasi }}</li>
        <li><strong>Pengaruh Rekomendasi:</strong> {{ $proposal->pengaruh_rekomendasi }}</li>
        <li><strong>Score IV:</strong> {{ $proposal->score_iv ?? 0 }}</li>
    </ul>

    <hr>
    <h5>Total Score: {{ $proposal->total_score ?? 0 }}</h5>
    <h5>Hasil Evaluasi:
        @if($proposal->total_score >= 83)
            <span class="badge bg-success">Dibantu</span>
        @elseif($proposal->total_score >= 47)
            <span class="badge bg-warning text-dark">Dipertimbangkan</span>
        @else
            <span class="badge bg-danger">Tidak Dibantu</span>
        @endif
    </h5>

    <p><strong>Catatan:</strong> {{ $proposal->catatan ?? '-' }}</p>
    <p><strong>Dibantu Sebesar:</strong> Rp {{ number_format($proposal->nominal_disetujui ?? 0) }}</p>

    <button onclick="window.print()" class="btn btn-primary mt-4"><i class="fas fa-print"></i> Cetak</button>
</div>
@endsection
