@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Jenis Proposal</h2>

    <form action="{{ route('jenis-proposals.update', $jenisProposal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Nama Jenis Proposal</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $jenisProposal->nama }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update Jenis Proposal</button>
    </form>
</div>
@endsection
