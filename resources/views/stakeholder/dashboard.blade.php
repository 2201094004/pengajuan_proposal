@extends('layouts.app')

@section('content')
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h3>Welcome to Stakeholder Dashboard</h3>
    </div>
    <div class="card-body">
        <p>Your role is: <strong>{{ auth()->user()->role }}</strong></p>
        <p>Berikut adalah daftar proposal yang telah diajukan oleh masyarakat dan perlu Anda evaluasi.</p>
    </div>
</div>

{{-- <div class="card">
    <div class="card-header">
        <h5>Proposal Masuk</h5>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>Nama</th>
                    <th>Judul</th>
                    <th>Kab/Kec/Desa</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($proposals as $proposal)
                    <tr>
                        <td>{{ $proposal->nama }}</td>
                        <td>{{ $proposal->title }}</td>
                        <td>
                            {{ $proposal->kabupaten->nama ?? '-' }}<br>
                            <small>{{ $proposal->kecamatan->nama ?? '-' }} / {{ $proposal->desa->nama ?? '-' }}</small>
                        </td>
                        <td class="text-center">
                            @switch($proposal->status)
                                @case('submitted') <span class="badge bg-primary">Dikirim</span> @break
                                @case('accepted') <span class="badge bg-success">Diterima</span> @break
                                @case('rejected') <span class="badge bg-danger">Ditolak</span> @break
                                @default <span class="badge bg-secondary">{{ $proposal->status }}</span>
                            @endswitch
                        </td>
                        <td class="text-center">
                            <a href="{{ route('stakeholder.evaluate.form', $proposal->id) }}" class="btn btn-sm btn-success">Evaluasi</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada proposal yang dikirimkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div> --}}
@endsection