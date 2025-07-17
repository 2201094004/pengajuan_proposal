@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm" data-aos="fade-up">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Desa</h5>
            <a href="{{ route('desas.create') }}" class="btn btn-sm btn-primary">+ Tambah Desa</a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>#</th>
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
                                <a href="{{ route('desas.edit', $desa->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('desas.destroy', $desa->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus desa ini?');">
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
    </div>
</div>
@endsection
