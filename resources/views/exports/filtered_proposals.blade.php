@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header bg-white">
            <h5 class="m-0">Ekspor Data Proposal</h5>
        </div>

        <div class="card-body">
            {{-- Form Filter Waktu --}}
            <form action="{{ route('proposals.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="range" class="form-label">Filter Berdasarkan Waktu</label>
                    <select name="range" id="range" class="form-select" required>
                        <option value="">-- Pilih Rentang Waktu --</option>
                        <option value="daily"   {{ request('range') == 'daily' ? 'selected' : '' }}>Harian</option>
                        <option value="weekly"  {{ request('range') == 'weekly' ? 'selected' : '' }}>Mingguan</option>
                        <option value="monthly" {{ request('range') == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                        <option value="yearly"  {{ request('range') == 'yearly' ? 'selected' : '' }}>Tahunan</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bx bx-filter-alt"></i> Filter
                    </button>
                </div>
            </form>

            {{-- Tombol Ekspor dan Tabel --}}
            @if(isset($filteredProposals) && count($filteredProposals) > 0)
                <div class="mt-4 d-flex gap-2">
                    {{-- Tombol Ekspor Excel --}}
                    <form action="{{ route('proposals.export.filtered') }}" method="GET">
                        <input type="hidden" name="range" value="{{ request('range') }}">
                        <button type="submit" class="btn btn-primary mb-3">
                            <i class="bx bx-download"></i> Ekspor ke Excel
                        </button>
                    </form>

                    {{-- Tombol Ekspor PDF (opsional) --}}
                    <form action="{{ route('proposals.export.pdf') }}" method="GET">
                        <input type="hidden" name="range" value="{{ request('range') }}">
                        <button type="submit" class="btn btn-danger mb-3">
                            <i class="bx bx-file"></i> Ekspor ke PDF
                        </button>
                    </form>
                </div>

                {{-- Tabel Data --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Judul</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th>No Rekening</th>
                                <th>Alamat</th>
                                <th>Kabupaten / Kecamatan / Desa</th>
                                <th>Kabupaten Tujuan</th>
                                <th>Jenis Proposal</th>
                                <th>Status</th>
                                <th>Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($filteredProposals as $proposal)
                                <tr>
                                    <td>{{ $proposal->nama }}</td>
                                    <td>{{ $proposal->title }}</td>
                                    <td>{{ $proposal->email }}</td>
                                    <td>{{ $proposal->no_hp }}</td>
                                    <td>{{ $proposal->no_rekening }}</td>
                                    <td>{{ $proposal->alamat }}</td>
                                    <td>
                                        {{ $proposal->kabupaten->nama ?? '-' }}<br>
                                        <small>{{ $proposal->kecamatan->nama ?? '-' }} / {{ $proposal->desa->nama ?? '-' }}</small>
                                    </td>
                                    <td>{{ $proposal->kabupatenTujuan->nama ?? '-' }}</td>
                                    <td>{{ $proposal->jenisProposal->nama ?? '-' }}</td>
                                    <td>
                                        @php
                                            $statusColor = match($proposal->status) {
                                                'draft'     => 'warning text-dark',
                                                'submitted' => 'primary',
                                                'accepted'  => 'success',
                                                'rejected'  => 'danger',
                                                'revision'  => 'info text-dark',
                                                default     => 'secondary',
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $statusColor }}">
                                            {{ ucfirst($proposal->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $proposal->created_at->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @elseif(request()->has('range'))
                <div class="alert alert-warning mt-4">
                    Tidak ada data proposal untuk rentang waktu <strong>{{ ucfirst(request('range')) }}</strong>.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
