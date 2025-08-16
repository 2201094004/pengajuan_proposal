@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm" data-aos="fade-up">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Kecamatan</h5>
            <a href="{{ route('admin.kecamatans.create') }}" class="btn btn-sm btn-primary">+ Tambah Kecamatan</a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Kecamatan</th>
                        <th>Kabupaten</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kecamatans as $kecamatan)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $kecamatan->nama }}</td>
                            <td>{{ $kecamatan->kabupaten->nama ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.kecamatans.edit', $kecamatan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.kecamatans.destroy', $kecamatan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kecamatan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada data kecamatan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
         @if(method_exists($kecamatans, 'hasPages') && $kecamatans->hasPages())
    <nav aria-label="Page navigation example" class="mt-3">
        <ul class="pagination justify-content-center">
            {{-- Tombol First --}}
            <li class="page-item {{ $kecamatans->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $kecamatans->url(1) }}">First</a>
            </li>

            {{-- Tombol Prev --}}
            <li class="page-item {{ $kecamatans->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $kecamatans->previousPageUrl() ?? '#' }}" aria-label="Previous">«</a>
            </li>

            {{-- Nomor Halaman --}}
            @foreach ($kecamatans->getUrlRange(1, $kecamatans->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $kecamatans->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Tombol Next --}}
            <li class="page-item {{ !$kecamatans->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $kecamatans->nextPageUrl() ?? '#' }}" aria-label="Next">»</a>
            </li>

            {{-- Tombol Last --}}
            <li class="page-item {{ !$kecamatans->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $kecamatans->url($kecamatans->lastPage()) }}">Last</a>
            </li>
        </ul>
    </nav>
@endif

    </div>
</div>
@endsection
