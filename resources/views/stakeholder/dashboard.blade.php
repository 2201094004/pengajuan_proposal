@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h3>Dashboard Stakeholder</h3>
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

            {{-- Diagram Pie --}}
            <div class="mt-5">
                <div class="row justify-content-center">
                    {{-- <div class="col-md-6 text-center">
                        <h5>Proposal per Kabupaten</h5>
                        <div style="max-width: 400px; margin: 0 auto;">
                            <canvas id="pieKabupaten"></canvas>
                        </div>
                    </div> --}}

                    <div class="col-md-6 text-center">
                        <h5>Proposal per Jenis Proposal</h5>
                        <div style="max-width: 400px; margin: 0 auto;">
                            <canvas id="pieJenisProposal"></canvas>
                        </div>
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
    // Bar Chart: Proposal per Kabupaten
    const ctxBar = document.getElementById('proposalChart').getContext('2d');
    const labelsKabupaten  = {!! json_encode($labelsKabupaten) !!};
    const dataProposal     = {!! json_encode($jumlahProposalPerKabupaten) !!};

    new Chart(ctxBar, {
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
            plugins: {
                legend: { display: false },
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

    // Pie Chart: Proposal per Kabupaten
    // const pieKabupatenCtx = document.getElementById('pieKabupaten').getContext('2d');
    // new Chart(pieKabupatenCtx, {
    //     type: 'pie',
    //     data: {
    //         labels: labelsKabupaten,
    //         datasets: [{
    //             data: dataProposal,
    //             backgroundColor: labelsKabupaten.map(() => `hsl(${Math.random() * 360}, 70%, 60%)`)
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         plugins: {
    //             legend: { position: 'right' },
    //             title: { display: true, text: 'Distribusi Proposal per Kabupaten' }
    //         }
    //     }
    // });

    // Pie Chart: Proposal per Jenis Proposal
    const pieJenisCtx = document.getElementById('pieJenisProposal').getContext('2d');
    const labelsJenis  = {!! json_encode($labelsJenisProposal) !!};
    const dataJenis    = {!! json_encode($jumlahPerJenisProposal) !!};

    new Chart(pieJenisCtx, {
        type: 'pie',
        data: {
            labels: labelsJenis,
            datasets: [{
                data: dataJenis,
                backgroundColor: labelsJenis.map(() => `hsl(${Math.random() * 360}, 70%, 60%)`)
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'right' },
                title: { display: true, text: 'Distribusi Proposal per Jenis Proposal' }
            }
        }
    });
</script>
@endsection
