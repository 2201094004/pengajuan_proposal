@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h3>Dashboard Admin</h3>
        </div>
        <div class="card-body">
            {{-- Kotak ringkasan --}}
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="alert alert-success">
                        <h5>Diterima</h5>
                        <h3>{{ $totalDiterima }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-danger">
                        <h5>Ditolak</h5>
                        <h3>{{ $totalDitolak }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-warning">
                        <h5>Revisi</h5>
                        <h3>{{ $totalRevisi }}</h3>
                    </div>
                </div>
            </div>

            {{-- Diagram batang --}}
            <div class="mt-5">
                <h4>Diagram Proposal Masuk Berdasarkan Kabupaten</h4>
                <canvas id="proposalChart" height="120"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('proposalChart').getContext('2d');

    // Data dari controller (Blade men‑json‑kan otomatis)
    const labelsKabupaten  = {!! json_encode($labelsKabupaten) !!};
    const dataProposal     = {!! json_encode($jumlahProposalPerKabupaten) !!};

    // Buat chart
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labelsKabupaten,
            datasets: [{
                label: 'Jumlah Proposal',
                data: dataProposal,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor:   'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                tooltip: { enabled: true }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0,
                    title: { display: true, text: 'Total Proposal' }
                }
            }
        }
    });
</script>
@endsection
