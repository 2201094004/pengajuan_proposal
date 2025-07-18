@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Jenis Proposal</h2>

    <form action="{{ route('jenis-proposals.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Jenis Proposal</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan Jenis Proposal</button>
    </form>
</div>
@endsection
