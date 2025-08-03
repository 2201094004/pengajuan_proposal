@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header bg-white">
            <h6 class="m-0">Edit Desa</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.desas.update', $desa->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Desa --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Desa</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $desa->nama }}" required>
                </div>

                {{-- Kecamatan --}}
                <div class="mb-3">
                    <label for="kecamatan_id" class="form-label">Kecamatan</label>
                    <select class="form-select" id="kecamatan_id" name="kecamatan_id" required>
                        @foreach($kecamatans as $kec)
                            <option value="{{ $kec->id }}" {{ $kec->id == $desa->kecamatan_id ? 'selected' : '' }}>
                                {{ $kec->nama }} ({{ $kec->kabupaten->nama }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.desas.index') }}" class="btn btn-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-success">Update Desa</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
