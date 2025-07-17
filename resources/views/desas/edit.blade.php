@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Desa</h2>

    <form action="{{ route('desas.update', $desa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Nama Desa</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $desa->nama }}" required>
        </div>

        <div class="form-group">
            <label for="kecamatan_id">Kecamatan</label>
            <select class="form-control" id="kecamatan_id" name="kecamatan_id" required>
                @foreach($kecamatans as $kec)
                    <option value="{{ $kec->id }}" {{ $kec->id == $desa->kecamatan_id ? 'selected' : '' }}>
                        {{ $kec->nama }} ({{ $kec->kabupaten->nama }})
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update Desa</button>
    </form>
</div>
@endsection
