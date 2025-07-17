@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Log Aktivitas</h4>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>User</th>
                        <th>Aktivitas</th>
                        <th>Keterangan</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->user->name }}</td>
                        <td>{{ $log->aktivitas }}</td>
                        <td>{{ $log->keterangan }}</td>
                        <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
