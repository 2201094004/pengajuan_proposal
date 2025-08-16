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

            {{-- Diagram Pie Jenis Proposal --}}
            <div class="row mt-5">
                <div class="col-md-6 offset-md-3 text-center">
                    <h5>Proposal per Jenis Proposal</h5>
                    <div style="max-width: 400px; margin: 0 auto;">
                        <canvas id="pieJenisProposal"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data dari Controller
    const labelsKabupaten = @json($labelsKabupaten);
    const dataProposal = @json($jumlahProposalPerKabupaten);
    const labelsJenis = @json($labelsJenisProposal);
    const dataJenis = @json($jumlahPerJenisProposal);

    // Warna tetap untuk jenis proposal
    const warnaTetapJenis = [
        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
        '#FF9F40', '#00A36C', '#C71585', '#4682B4', '#FFD700'
    ];

    // Chart: Bar - Jumlah Proposal per Kabupaten
    new Chart(document.getElementById('proposalChart'), {
        type: 'bar',
        data: {
            labels: labelsKabupaten,
            datasets: [{
                label: 'Jumlah Proposal',
                data: dataProposal,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, precision: 0 } }
        }
    });

    // Chart: Pie - Proposal per Jenis Proposal
    new Chart(document.getElementById('pieJenisProposal'), {
        type: 'pie',
        data: {
            labels: labelsJenis,
            datasets: [{
                data: dataJenis,
                backgroundColor: warnaTetapJenis.slice(0, labelsJenis.length),
                borderColor: '#ffffff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' },
                title: { display: true, text: 'Distribusi Proposal per Jenis Proposal' }
            }
        }
    });
</script>
@endsection
