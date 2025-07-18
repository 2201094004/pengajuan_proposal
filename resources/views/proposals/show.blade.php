@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header bg-white">
            <h5 class="m-0">{{ $proposal->title }}</h5>
        </div>

        <div class="card-body">
            <p><strong>Status:</strong>
                @switch($proposal->status)
                    @case('draft') <span class="badge bg-warning text-dark">Draft</span> @break
                    @case('submitted') <span class="badge bg-primary">Dikirim</span> @break
                    @case('accepted') <span class="badge bg-success">Diterima</span> @break
                    @case('rejected') <span class="badge bg-danger">Ditolak</span> @break
                    @case('revised') <span class="badge bg-info text-dark">Revisi</span> @break
                    @default <span class="badge bg-secondary">-</span>
                @endswitch
            </p>

            <p><strong>Deskripsi:</strong></p>
            <p>{{ $proposal->description }}</p>

            <hr>

            <p><strong>Nama Pengaju:</strong> {{ $proposal->nama }}</p>
            <p><strong>Email:</strong> {{ $proposal->email }}</p>
            <p><strong>No HP:</strong> {{ $proposal->no_hp }}</p>
            <p><strong>No Rekening:</strong> {{ $proposal->no_rekening }}</p>
            <p><strong>Alamat:</strong> {{ $proposal->alamat }}</p>

            <p><strong>Asal:</strong><br>
                {{ $proposal->kabupaten->nama ?? '-' }},
                {{ $proposal->kecamatan->nama ?? '-' }},
                {{ $proposal->desa->nama ?? '-' }}
            </p>

            <p><strong>Kabupaten Tujuan:</strong> {{ $proposal->kabupaten_tujuan }}</p>

            <p><strong>Jenis Proposal:</strong> {{ $proposal->jenisProposal->nama ?? '-' }}</p>

            @if ($proposal->proposal_file)
                <hr>
                <h6>Dokumen Proposal:</h6>
                <a href="{{ asset('storage/documents/' . $proposal->proposal_file) }}" target="_blank" class="btn btn-outline-secondary">
                    Lihat Proposal (PDF)
                </a>
            @else
                <p class="text-muted">Belum ada dokumen yang diunggah.</p>
            @endif

            <div class="mt-4">
                <a href="{{ route('proposals.index') }}" class="btn btn-primary">← Kembali ke Daftar Proposal</a>
            </div>
        </div>
    </div>
</div>
@endsection
