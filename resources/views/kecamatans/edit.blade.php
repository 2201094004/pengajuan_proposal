@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header bg-white">
            <h6 class="m-0">Edit Kecamatan</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.kecamatans.update', $kecamatan->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Kecamatan --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Kecamatan</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $kecamatan->nama }}" required>
                </div>

                {{-- Kabupaten --}}
                <div class="mb-3">
                    <label for="kabupaten_id" class="form-label">Kabupaten</label>
                    <select class="form-select" id="kabupaten_id" name="kabupaten_id" required>
                        @foreach($kabupatens as $kab)
                            <option value="{{ $kab->id }}" {{ $kab->id == $kecamatan->kabupaten_id ? 'selected' : '' }}>
                                {{ $kab->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.kecamatans.index') }}" class="btn btn-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-success">Update Kecamatan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
