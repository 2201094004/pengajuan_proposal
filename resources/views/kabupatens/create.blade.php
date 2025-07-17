@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Kabupaten</h2>

    <form action="{{ route('kabupatens.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Kabupaten</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan Kabupaten</button>
    </form>
</div>
@endsection
