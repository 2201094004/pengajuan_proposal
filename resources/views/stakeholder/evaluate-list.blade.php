@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Daftar Proposal untuk Dievaluasi</h4>
    </div>
    <div class="card-body">
        @forelse ($proposals as $proposal)
            <div class="mb-3">
                <strong>{{ $proposal->title }}</strong><br>
                <a href="{{ route('stakeholder.evaluate.form', $proposal->id) }}" class="btn btn-sm btn-primary mt-1">
                    Evaluasi Sekarang
                </a>
            </div>
        @empty
            <p>Tidak ada proposal yang bisa dievaluasi saat ini.</p>
        @endforelse
    </div>
</div>
@endsection
