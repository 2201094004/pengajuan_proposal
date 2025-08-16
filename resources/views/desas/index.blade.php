@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm" data-aos="fade-up">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Desa</h5>
            <a href="{{ route('admin.desas.create') }}" class="btn btn-sm btn-primary">+ Tambah Desa</a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Desa</th>
                        <th>Kecamatan</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($desas as $desa)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $desa->nama }}</td>
                            <td>{{ $desa->kecamatan->nama ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.desas.edit', $desa->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.desas.destroy', $desa->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus desa ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada data desa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(method_exists($desas, 'hasPages') && $desas->hasPages())
    <nav aria-label="Page navigation example" class="mt-3">
        <ul class="pagination justify-content-center">
            {{-- Tombol First --}}
            <li class="page-item {{ $desas->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $desas->url(1) }}">First</a>
            </li>

            {{-- Tombol Prev --}}
            <li class="page-item {{ $desas->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $desas->previousPageUrl() ?? '#' }}" aria-label="Previous">«</a>
            </li>

            {{-- Nomor Halaman --}}
            @foreach ($desas->getUrlRange(1, $desas->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $desas->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Tombol Next --}}
            <li class="page-item {{ !$desas->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $desas->nextPageUrl() ?? '#' }}" aria-label="Next">»</a>
            </li>

            {{-- Tombol Last --}}
            <li class="page-item {{ !$desas->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $desas->url($desas->lastPage()) }}">Last</a>
            </li>
        </ul>
    </nav>
@endif

    </div>
</div>
@endsection
