@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header bg-white">
            <h6 class="m-0">Edit Proposal</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('proposals.update', $proposal->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $proposal->nama }}" required>
                </div>

                {{-- Judul --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Proposal</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $proposal->title }}" required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ $proposal->description }}</textarea>
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $proposal->email }}" required>
                </div>

                {{-- No HP --}}
                <div class="mb-3">
                    <label for="no_hp" class="form-label">No HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $proposal->no_hp }}" required>
                </div>

                {{-- No Rekening --}}
                <div class="mb-3">
                    <label for="no_rekening" class="form-label">No Rekening</label>
                    <input type="text" class="form-control" id="no_rekening" name="no_rekening" value="{{ $proposal->no_rekening }}" required>
                </div>

                {{-- Alamat --}}
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="2" required>{{ $proposal->alamat }}</textarea>
                </div>

                {{-- Lokasi --}}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="kabupaten_id" class="form-label">Kabupaten</label>
                        <select class="form-select" name="kabupaten_id" id="kabupaten_id" required>
                            <option value="">-- Pilih Kabupaten --</option>
                            @foreach($kabupatens as $kab)
                                <option value="{{ $kab->id }}" {{ $proposal->kabupaten_id == $kab->id ? 'selected' : '' }}>{{ $kab->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="kecamatan_id" class="form-label">Kecamatan</label>
                        <select class="form-select" name="kecamatan_id" id="kecamatan_id">
                            <option value="">-- Pilih Kecamatan --</option>
                            @foreach($kecamatans as $kec)
                                <option value="{{ $kec->id }}" {{ $proposal->kecamatan_id == $kec->id ? 'selected' : '' }}>{{ $kec->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="desa_id" class="form-label">Desa</label>
                        <select class="form-select" name="desa_id" id="desa_id">
                            <option value="">-- Pilih Desa --</option>
                            @foreach($desas as $des)
                                <option value="{{ $des->id }}" {{ $proposal->desa_id == $des->id ? 'selected' : '' }}>{{ $des->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Kabupaten Tujuan --}}
                <div class="mb-3">
                    <label for="kabupaten_tujuan" class="form-label">Kabupaten Tujuan</label>
                    <select class="form-select" id="kabupaten_tujuan" name="kabupaten_tujuan" required>
                        <option value="">-- Pilih Kabupaten Tujuan --</option>
                        @foreach($kabupatens as $kabupaten)
                            <option value="{{ $kabupaten->nama }}" {{ $proposal->kabupaten_tujuan == $kabupaten->nama ? 'selected' : '' }}>
                                {{ $kabupaten->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Jenis Proposal --}}
                <div class="mb-3">
                    <label for="jenis_proposal_id" class="form-label">Jenis Proposal</label>
                    <select name="jenis_proposal_id" id="jenis_proposal_id" class="form-select" required>
                        <option value="">-- Pilih Jenis Proposal --</option>
                        @foreach ($jenisProposals as $jenis)
                            <option value="{{ $jenis->id }}" {{ $proposal->jenis_proposal_id == $jenis->id ? 'selected' : '' }}>
                                {{ $jenis->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Dokumen Proposal --}}
                <div class="mb-3">
                    <label for="document" class="form-label">Dokumen Baru (Opsional)</label>
                    <input type="file" class="form-control" id="document" name="document" accept="application/pdf">
                    @if($proposal->document)
                        <small class="form-text text-muted">
                            Dokumen saat ini: <a href="{{ asset('storage/documents/' . $proposal->document) }}" target="_blank">Lihat</a>
                        </small>
                    @endif
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('proposals.index') }}" class="btn btn-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-warning">Update Proposal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
