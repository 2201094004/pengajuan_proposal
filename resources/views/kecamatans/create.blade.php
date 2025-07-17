@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Kecamatan</h2>

    <form action="{{ route('kecamatans.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Kecamatan</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="form-group">
            <label for="kabupaten_id">Kabupaten</label>
            <select class="form-control" id="kabupaten_id" name="kabupaten_id" required>
                <option value="">-- Pilih Kabupaten --</option>
                @foreach($kabupatens as $kabupaten)
                    <option value="{{ $kabupaten->id }}">{{ $kabupaten->nama }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan Kecamatan</button>
    </form>
</div>
@endsection
