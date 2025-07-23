@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header bg-white">
            <h6 class="m-0">Tambah Kabupaten</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.kabupatens.store') }}" method="POST">
                @csrf

                {{-- Nama Kabupaten --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Kabupaten</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.kabupatens.index') }}" class="btn btn-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Kabupaten</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
