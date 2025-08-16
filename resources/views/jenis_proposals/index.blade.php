@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm" data-aos="fade-up">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Jenis Proposal</h5>
            <a href="{{ route('admin.jenis_proposals.create') }}" class="btn btn-sm btn-primary">+ Tambah Jenis</a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Jenis Proposal</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenisProposals as $jenis)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $jenis->nama }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.jenis_proposals.edit', $jenis->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.jenis_proposals.destroy', $jenis->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jenis proposal ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Belum ada data jenis proposal.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
         @if(method_exists($jenisProposals, 'hasPages') && $jenisProposals->hasPages())
    <nav aria-label="Page navigation example" class="mt-3">
        <ul class="pagination justify-content-center">
            {{-- Tombol First --}}
            <li class="page-item {{ $jenisProposals->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $jenisProposals->url(1) }}">First</a>
            </li>

            {{-- Tombol Prev --}}
            <li class="page-item {{ $jenisProposals->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $jenisProposals->previousPageUrl() ?? '#' }}" aria-label="Previous">«</a>
            </li>

            {{-- Nomor Halaman --}}
            @foreach ($jenisProposals->getUrlRange(1, $jenisProposals->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $jenisProposals->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Tombol Next --}}
            <li class="page-item {{ !$jenisProposals->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $jenisProposals->nextPageUrl() ?? '#' }}" aria-label="Next">»</a>
            </li>

            {{-- Tombol Last --}}
            <li class="page-item {{ !$jenisProposals->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $jenisProposals->url($jenisProposals->lastPage()) }}">Last</a>
            </li>
        </ul>
    </nav>
@endif

    </div>
</div>
@endsection
