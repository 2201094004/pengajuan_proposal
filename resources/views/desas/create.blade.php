@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Desa</h2>

    <form action="{{ route('desas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Desa</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="form-group">
            <label for="kecamatan_id">Kecamatan</label>
            <select class="form-control" id="kecamatan_id" name="kecamatan_id" required>
                <option value="">-- Pilih Kecamatan --</option>
                @foreach($kecamatans as $kecamatan)
                    <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama }} ({{ $kecamatan->kabupaten->nama }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan Desa</button>
    </form>
</div>
@endsection
