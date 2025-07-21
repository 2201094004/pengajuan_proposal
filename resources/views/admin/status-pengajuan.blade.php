@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        {{-- HEADER --}}
        <div class="card-header bg-white">
            <h5 class="mb-3">Status Pengajuan Proposal</h5>

            <div class="row g-3">
                {{-- Filter Kabupaten --}}
                <div class="col-md-4">
                    <label for="kabupaten_id" class="form-label">Filter Kabupaten</label>
                    <select name="kabupaten_id" id="kabupaten_id" class="form-select">
                        <option value="">-- Semua Kabupaten --</option>
                        @foreach($kabupatens as $kab)
                            <option value="{{ $kab->id }}" {{ request('kabupaten_id') == $kab->id ? 'selected' : '' }}>
                                {{ $kab->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Form Export --}}
                <div class="col-md-8 d-flex align-items-end justify-content-md-end">
                    <form action="#" method="GET" class="d-flex align-items-center flex-wrap">
                        {{-- Rentang Waktu --}}
                        <select name="range" class="form-select form-select-sm me-2 mb-2" style="max-width: 180px;">
                            <option value="daily"  {{ request('range') == 'daily'  ? 'selected' : '' }}>Harian</option>
                            <option value="weekly" {{ request('range') == 'weekly' ? 'selected' : '' }}>Mingguan</option>
                            <option value="monthly" {{ request('range') == 'monthly'? 'selected' : '' }}>Bulanan</option>
                            <option value="yearly"  {{ request('range') == 'yearly' ? 'selected' : '' }}>Tahunan</option>
                        </select>

                        {{-- Tombol Export --}}
                        <a href="{{ route('admin.proposals.export.excel', ['range' => request('range','daily'), 'search' => request('search')]) }}"
                           class="btn btn-sm btn-success me-2 mb-2">
                            <i class="fas fa-file-excel"></i> Excel
                        </a>
                        <a href="{{ route('admin.proposals.export.pdf', ['range' => request('range','daily'), 'search' => request('search')]) }}"
                           class="btn btn-sm btn-danger mb-2">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            {{-- FORM PENCARIAN --}}
            <form method="GET" action="{{ route('admin.status-pengajuan') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama atau judul..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </form>

            {{-- TABEL PROPOSAL --}}
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Judul</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>No Rekening</th>
                            <th>Alamat</th>
                            <th>Asal (Kab/Kec/Desa)</th>
                            <th>Tujuan Kabupaten</th>
                            <th>Jenis Proposal</th>
                            <th>Status</th>
                            <th>Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($proposals as $proposal)
                            <tr>
                                <td>{{ $proposal->nama }}</td>
                                <td>{{ $proposal->title }}</td>
                                <td>{{ $proposal->email }}</td>
                                <td>{{ $proposal->no_hp }}</td>
                                <td>{{ $proposal->no_rekening }}</td>
                                <td>{{ $proposal->alamat }}</td>
                                <td>
                                    {{ optional($proposal->kabupaten)->nama ?? '-' }}<br>
                                    <small>{{ optional($proposal->kecamatan)->nama ?? '-' }} / {{ optional($proposal->desa)->nama ?? '-' }}</small>
                                </td>
                                <td>{{ optional($proposal->kabupatenTujuan)->nama ?? '-' }}</td>
                                <td>{{ optional($proposal->jenisProposal)->nama ?? '-' }}</td>
                                <td>
                                    @switch($proposal->status)
                                        @case('draft')     <span class="badge bg-warning text-dark">Draft</span> @break
                                        @case('submitted') <span class="badge bg-primary">Dikirim</span> @break
                                        @case('accepted')  <span class="badge bg-success">Diterima</span> @break
                                        @case('rejected')  <span class="badge bg-danger">Ditolak</span> @break
                                        @case('revised')   <span class="badge bg-info text-dark">Revisi</span> @break
                                        @default           <span class="badge bg-secondary">-</span>
                                    @endswitch
                                </td>
                                <td>
                                    @if($proposal->proposal_file)
                                        <a href="{{ asset('storage/documents/'.$proposal->proposal_file) }}"
                                           target="_blank" class="btn btn-sm btn-outline-secondary">
                                           Lihat
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.proposals.penilaian', $proposal->id) }}"
                                        class="btn btn-sm btn-info mb-1" target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    @if($proposal->status === 'submitted')
                                        <form action="{{ route('admin.proposal.accept', $proposal->id) }}" method="POST" class="d-inline">@csrf
                                            <button class="btn btn-sm btn-success">✓ Terima</button>
                                        </form>
                                        <form action="{{ route('admin.proposal.reject', $proposal->id) }}" method="POST" class="d-inline">@csrf
                                            <button class="btn btn-sm btn-danger">× Tolak</button>
                                        </form>
                                        <form action="{{ route('admin.proposal.revision', $proposal->id) }}" method="POST" class="d-inline">@csrf
                                            <button class="btn btn-sm btn-warning">↺ Revisi</button>
                                        </form>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center text-muted">Belum ada pengajuan proposal.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
