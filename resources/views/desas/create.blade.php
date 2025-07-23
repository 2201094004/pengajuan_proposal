@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header bg-white">
            <h6 class="m-0">Tambah Desa</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.desas.store') }}" method="POST">
                @csrf

                {{-- Nama Desa --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Desa</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>

                {{-- Kecamatan --}}
                <div class="mb-3">
                    <label for="kecamatan_id" class="form-label">Kecamatan</label>
                    <select class="form-select" id="kecamatan_id" name="kecamatan_id" required>
                        <option value="">-- Pilih Kecamatan --</option>
                        @foreach($kecamatans as $kecamatan)
                            <option value="{{ $kecamatan->id }}">
                                {{ $kecamatan->nama }} ({{ $kecamatan->kabupaten->nama }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.desas.index') }}" class="btn btn-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Desa</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
