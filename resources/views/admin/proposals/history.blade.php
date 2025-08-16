@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5>Riwayat Proposal: {{ $proposal->title }}</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Oleh</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($proposal->histories as $i => $history)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>
                                @if($history->action == 'accepted')
                                    <span class="badge bg-success">Diterima</span>
                                @elseif($history->action == 'rejected')
                                    <span class="badge bg-danger">Ditolak</span>
                                @elseif($history->action == 'revised')
                                    <span class="badge bg-warning text-dark">Revisi</span>
                                @endif
                            </td>
                            <td>{{ $history->user->name ?? '-' }}</td>
                            <td>{{ $history->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada riwayat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
