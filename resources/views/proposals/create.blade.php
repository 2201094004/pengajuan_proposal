@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header bg-white">
            <h6 class="m-0">Buat Proposal Baru</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('proposals.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nama --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>

                {{-- Judul Proposal --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Proposal</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                {{-- No HP --}}
                <div class="mb-3">
                    <label for="no_hp" class="form-label">No HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                </div>

                {{-- No Rekening --}}
                <div class="mb-3">
                    <label for="no_rekening" class="form-label">No Rekening</label>
                    <input type="text" class="form-control" id="no_rekening" name="no_rekening" required>
                </div>

                {{-- Alamat --}}
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="2" required></textarea>
                </div>

                {{-- Lokasi Asal --}}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="kabupaten_id" class="form-label">Kabupaten Asal</label>
                        <select class="form-select" name="kabupaten_id" id="kabupaten_id" required>
                            <option value="">-- Pilih Kabupaten --</option>
                            @foreach($kabupatens as $kab)
                                <option value="{{ $kab->id }}">{{ $kab->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="kecamatan_id" class="form-label">Kecamatan</label>
                        <select class="form-select" name="kecamatan_id" id="kecamatan_id">
                            <option value="">-- Pilih Kecamatan --</option>
                            @foreach($kecamatans as $kec)
                                <option value="{{ $kec->id }}">{{ $kec->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="desa_id" class="form-label">Desa</label>
                        <select class="form-select" name="desa_id" id="desa_id">
                            <option value="">-- Pilih Desa --</option>
                            @foreach($desas as $des)
                                <option value="{{ $des->id }}">{{ $des->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Kabupaten Tujuan --}}
                <div class="mb-3">
                    <label for="kabupaten_tujuan" class="form-label">Kabupaten Tujuan</label>
                    <select name="kabupaten_tujuan_id" class="form-control">
                        <option value="">-- Pilih Kabupaten Tujuan --</option>
                        @foreach($kabupatens as $kabupaten)
                            <option value="{{ $kabupaten->id }}">
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
                            <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- File Dokumen --}}
                <div class="mb-3">
                    <label for="proposal_file" class="form-label">Unggah Dokumen Proposal (PDF)</label>
                    <input type="file" class="form-control" id="proposal_file" name="document" accept="application/pdf">
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('proposals.index') }}" class="btn btn-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Proposal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
