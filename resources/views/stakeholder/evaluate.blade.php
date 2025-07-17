@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5>Evaluasi Proposal: {{ $proposal->title }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('stakeholder.evaluate.store', $proposal->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="pemberi_rekomendasi" class="form-label">Pemberi Rekomendasi</label>
                    <input type="text" class="form-control" name="pemberi_rekomendasi" required>
                </div>

                <div class="row">
                    @php
                        $aspek = [
                            'nilai_status' => 'Status Proposal',
                            'nilai_pengaruh' => 'Pengaruh Kegiatan',
                            'nilai_popularitas' => 'Popularitas Pemohon',
                            'nilai_hubungan_perusahaan' => 'Hubungan dengan Perusahaan',
                            'nilai_pelaksana' => 'Kemampuan Pelaksana',
                            'nilai_tujuan' => 'Tujuan Kegiatan',
                            'nilai_lokasi' => 'Lokasi Kegiatan',
                            'nilai_waktu' => 'Waktu Pelaksanaan',
                            'nilai_estimasi_dana' => 'Estimasi Dana',
                            'nilai_dampak' => 'Dampak Sosial',
                            'nilai_partisipasi' => 'Partisipasi Masyarakat',
                            'nilai_pengaruh_perusahaan' => 'Pengaruh ke Perusahaan',
                            'nilai_pencitraan' => 'Pencitraan Perusahaan',
                            'nilai_referensi' => 'Referensi/Rekomendasi'
                        ];
                    @endphp

                    @foreach($aspek as $key => $label)
                        <div class="col-md-6 mb-3">
                            <label for="{{ $key }}" class="form-label">{{ $label }}</label>
                            <input type="number" class="form-control" name="{{ $key }}" min="1" max="10" required>
                        </div>
                    @endforeach
                </div>

                <div class="mb-3">
                    <label for="kesimpulan" class="form-label">Kesimpulan</label>
                    <select name="kesimpulan" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <option value="dibantu">Dibantu</option>
                        <option value="tidak dibantu">Tidak Dibantu</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan Tambahan</label>
                    <textarea name="catatan" class="form-control" rows="3"></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('stakeholder.dashboard') }}" class="btn btn-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan Evaluasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
