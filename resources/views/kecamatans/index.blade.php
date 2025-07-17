@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm" data-aos="fade-up">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Kecamatan</h5>
            <a href="{{ route('kecamatans.create') }}" class="btn btn-sm btn-primary">+ Tambah Kecamatan</a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>#</th>
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
                                <a href="{{ route('kecamatans.edit', $kecamatan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('kecamatans.destroy', $kecamatan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kecamatan ini?');">
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
    </div>
</div>
@endsection
