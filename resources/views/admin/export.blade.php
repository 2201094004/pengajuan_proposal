@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header bg-white">
            <h5 class="m-0">Ekspor Data Proposal</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('proposals.export.filtered') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="range" class="form-label">Filter Berdasarkan Waktu</label>
                    <select name="range" id="range" class="form-select" required>
                        <option value="">-- Pilih Rentang Waktu --</option>
                        <option value="daily" {{ request('range') == 'daily' ? 'selected' : '' }}>Harian</option>
                        <option value="weekly" {{ request('range') == 'weekly' ? 'selected' : '' }}>Mingguan</option>
                        <option value="monthly" {{ request('range') == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                        <option value="yearly" {{ request('range') == 'yearly' ? 'selected' : '' }}>Tahunan</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bx bx-filter-alt"></i> Filter
                    </button>
                </div>
            </form>

            @if(isset($filteredProposals) && count($filteredProposals) > 0)
                <div class="mt-4">
                    <form action="{{ route('proposals.export.filtered') }}" method="GET">
                        <input type="hidden" name="range" value="{{ request('range') }}">
                        <button type="submit" class="btn btn-primary mb-3">
                            <i class="bx bx-download"></i> Ekspor ke Excel
                        </button>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="text-center">
                                <tr>
                                    <th>Nama</th> {{-- Tambahan --}}
                                    <th>Judul</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>No Rekening</th>
                                    <th>Status</th>
                                    <th>Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($filteredProposals as $proposal)
                                    <tr>
                                        <td>{{ $proposal->nama }}</td> {{-- Tambahan --}}
                                        <td>{{ $proposal->title }}</td>
                                        <td>{{ $proposal->email }}</td>
                                        <td>{{ $proposal->no_hp }}</td>
                                        <td>{{ $proposal->no_rekening }}</td>
                                        <td>
                                            <span class="badge bg-{{ match($proposal->status) {
                                                'draft' => 'warning text-dark',
                                                'submitted' => 'primary',
                                                'accepted' => 'success',
                                                'rejected' => 'danger',
                                                'revision' => 'secondary',
                                                default => 'light text-dark'
                                            } }}">
                                                {{ ucfirst($proposal->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $proposal->created_at->format('d-m-Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
