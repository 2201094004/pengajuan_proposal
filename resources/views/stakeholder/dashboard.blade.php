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

@endsection