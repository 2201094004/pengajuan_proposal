@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Kecamatan</h2>

    <form action="{{ route('kecamatans.update', $kecamatan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Nama Kecamatan</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $kecamatan->nama }}" required>
        </div>

        <div class="form-group">
            <label for="kabupaten_id">Kabupaten</label>
            <select class="form-control" id="kabupaten_id" name="kabupaten_id" required>
                @foreach($kabupatens as $kab)
                    <option value="{{ $kab->id }}" {{ $kab->id == $kecamatan->kabupaten_id ? 'selected' : '' }}>
                        {{ $kab->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update Kecamatan</button>
    </form>
</div>
@endsection
