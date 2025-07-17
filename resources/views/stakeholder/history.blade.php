@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Riwayat Evaluasi Proposal</h4>
    </div>
    <div class="card-body">
        @if ($evaluations->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Judul Proposal</th>
                        <th>Total Skor</th>
                        <th>Kesimpulan</th>
                        <th>Catatan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evaluations as $eval)
                        <tr>
                            <td>{{ $eval->proposal->title ?? '-' }}</td>
                            <td>{{ $eval->total_score }}</td>
                            <td>{{ ucfirst($eval->kesimpulan) }}</td>
                            <td>{{ $eval->catatan ?? '-' }}</td>
                            <td>{{ $eval->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada riwayat evaluasi yang ditemukan.</p>
        @endif
    </div>
</div>
@endsection
