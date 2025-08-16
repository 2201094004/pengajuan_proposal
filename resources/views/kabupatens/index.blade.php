@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm" data-aos="fade-up">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Kabupaten</h5>
            <a href="{{ route('admin.kabupatens.create') }}" class="btn btn-sm btn-primary">+ Tambah Kabupaten</a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Kabupaten</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kabupatens as $kabupaten)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $kabupaten->nama }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.kabupatens.edit', $kabupaten->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.kabupatens.destroy', $kabupaten->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kabupaten ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Belum ada data kabupaten.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
         @if(method_exists($kabupatens, 'hasPages') && $kabupatens->hasPages())
    <nav aria-label="Page navigation example" class="mt-3">
        <ul class="pagination justify-content-center">
            {{-- Tombol First --}}
            <li class="page-item {{ $kabupatens->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $kabupatens->url(1) }}">First</a>
            </li>

            {{-- Tombol Prev --}}
            <li class="page-item {{ $kabupatens->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $kabupatens->previousPageUrl() ?? '#' }}" aria-label="Previous">«</a>
            </li>

            {{-- Nomor Halaman --}}
            @foreach ($kabupatens->getUrlRange(1, $kabupatens->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $kabupatens->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Tombol Next --}}
            <li class="page-item {{ !$kabupatens->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $kabupatens->nextPageUrl() ?? '#' }}" aria-label="Next">»</a>
            </li>

            {{-- Tombol Last --}}
            <li class="page-item {{ !$kabupatens->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $kabupatens->url($kabupatens->lastPage()) }}">Last</a>
            </li>
        </ul>
    </nav>
@endif

    </div>
</div>
@endsection
