@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (auth()->user()->role === 'admin')
                        <script>
                            window.location.href = "{{ route('admin.dashboard') }}";
                        </script>
                    @elseif (auth()->user()->role === 'masyarakat')
                        <script>
                            window.location.href = "{{ route('masyarakat.dashboard') }}";
                        </script>
                    @elseif (auth()->user()->role === 'stakeholder')
                        <script>
                            window.location.href = "{{ route('stakeholder.dashboard') }}";
                        </script>
                    @else
                        <p>{{ __('Unauthorized access.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
