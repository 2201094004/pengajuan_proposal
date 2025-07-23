@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header bg-white">
            <h6 class="m-0">Tambah Jenis Proposal</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.jenis-proposals.store') }}" method="POST">
                @csrf

                {{-- Nama Jenis Proposal --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Jenis Proposal</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.jenis-proposals.index') }}" class="btn btn-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Jenis Proposal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
