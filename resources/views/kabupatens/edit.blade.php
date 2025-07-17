@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Kabupaten</h2>

    <form action="{{ route('kabupatens.update', $kabupaten->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Nama Kabupaten</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $kabupaten->nama }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update Kabupaten</button>
    </form>
</div>
@endsection
