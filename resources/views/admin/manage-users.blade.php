@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm" data-aos="fade-up">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Manajemen Pengguna</h5>
            <a href="{{ route('admin.create-user') }}" class="btn btn-sm btn-primary">+ Tambah Pengguna</a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">
                                <span class="badge bg-secondary text-uppercase">{{ $user->role }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.edit-user', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('admin.delete-user', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pengguna ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada pengguna terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(method_exists($users, 'hasPages') && $users->hasPages())
    <nav aria-label="Page navigation example" class="mt-3">
        <ul class="pagination justify-content-center">
            {{-- Tombol First --}}
            <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $users->url(1) }}">First</a>
            </li>

            {{-- Tombol Prev --}}
            <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $users->previousPageUrl() ?? '#' }}" aria-label="Previous">«</a>
            </li>

            {{-- Nomor Halaman --}}
            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Tombol Next --}}
            <li class="page-item {{ !$users->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $users->nextPageUrl() ?? '#' }}" aria-label="Next">»</a>
            </li>

            {{-- Tombol Last --}}
            <li class="page-item {{ !$users->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $users->url($users->lastPage()) }}">Last</a>
            </li>
        </ul>
    </nav>
@endif


    </div>
</div>
@endsection
