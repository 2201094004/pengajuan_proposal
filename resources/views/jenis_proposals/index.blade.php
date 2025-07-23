@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm" data-aos="fade-up">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Jenis Proposal</h5>
            <a href="{{ route('admin.jenis-proposals.create') }}" class="btn btn-sm btn-primary">+ Tambah Jenis</a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>#</th>
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
                                <a href="{{ route('admin.jenis-proposals.edit', $jenis->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.jenis-proposals.destroy', $jenis->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jenis proposal ini?');">
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
    </div>
</div>
@endsection
