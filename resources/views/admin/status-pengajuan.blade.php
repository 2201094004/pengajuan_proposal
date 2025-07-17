@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0">Status Pengajuan Proposal</h6>
        </div>

        <div class="card-body">

            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('admin.status-pengajuan') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama atau judul..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Nama</th>
                            <th>Judul</th>
                            <th>Kab/Kec/Desa</th>
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
                                <td>
                                    {{ $proposal->kabupaten->nama ?? '-' }} <br>
                                    <small>{{ $proposal->kecamatan->nama ?? '-' }} / {{ $proposal->desa->nama ?? '-' }}</small>
                                </td>
                                <td class="text-center">
                                    @switch($proposal->status)
                                        @case('draft') <span class="badge bg-warning text-dark">Draft</span> @break
                                        @case('submitted') <span class="badge bg-primary">Dikirim</span> @break
                                        @case('accepted') <span class="badge bg-success">Diterima</span> @break
                                        @case('rejected') <span class="badge bg-danger">Ditolak</span> @break
                                        @case('revised') <span class="badge bg-info text-dark">Revisi</span> @break
                                        @default <span class="badge bg-secondary">-</span>
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    @if($proposal->document)
                                        <a href="{{ asset('storage/documents/' . $proposal->document) }}" target="_blank" class="btn btn-sm btn-outline-secondary">Lihat</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($proposal->status == 'submitted')
                                        <form action="{{ route('admin.proposal.accept', $proposal->id) }}" method="POST" class="d-inline">@csrf
                                            <button class="btn btn-success btn-sm">Terima</button>
                                        </form>
                                        <form action="{{ route('admin.proposal.reject', $proposal->id) }}" method="POST" class="d-inline">@csrf
                                            <button class="btn btn-danger btn-sm">Tolak</button>
                                        </form>
                                        <form action="{{ route('admin.proposal.revision', $proposal->id) }}" method="POST" class="d-inline">@csrf
                                            <button class="btn btn-warning btn-sm">Revisi</button>
                                        </form>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted">Belum ada pengajuan proposal.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
