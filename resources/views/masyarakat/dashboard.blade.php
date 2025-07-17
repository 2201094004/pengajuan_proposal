@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h3>Welcome to Masyarakat Dashboard</h3>
    </div>
    <div class="card-body">
        <p>Your role is: <strong>{{ auth()->user()->role }}</strong></p>
        <p>Here you can manage your activities and view important updates.</p>
    </div>
</div>
@endsection

