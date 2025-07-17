@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header bg-white">
            <h5 class="m-0">{{ $proposal->title }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Status:</strong> {{ ucfirst($proposal->status) }}</p>
            <p><strong>Description:</strong></p>
            <p>{{ $proposal->description }}</p>

            @if ($proposal->document)
                <hr>
                <h6>Attached Document:</h6>
                <a href="{{ asset('storage/' . $proposal->document) }}" target="_blank" class="btn btn-outline-secondary">
                    View Proposal PDF
                </a>
            @else
                <p class="text-muted">No document uploaded.</p>
            @endif

            <div class="mt-4">
                <a href="{{ route('proposals.index') }}" class="btn btn-primary">← Back to Proposals</a>
            </div>
        </div>
    </div>
</div>
@endsection
