<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h3>Dashboard Admin</h3>
        </div>
        <div class="card-body">
            
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="alert alert-success">
                        <h5>Diterima</h5>
                        <h3><?php echo e($totalDiterima); ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-danger">
                        <h5>Ditolak</h5>
                        <h3><?php echo e($totalDitolak); ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-warning">
                        <h5>Revisi</h5>
                        <h3><?php echo e($totalRevisi); ?></h3>
                    </div>
                </div>
            </div>

            
            <div class="mt-5">
                <h4>Diagram Proposal Masuk Berdasarkan Kabupaten</h4>
                <canvas id="proposalChart" height="120"></canvas>
            </div>

            
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data dari Controller
    const labelsKabupaten = <?php echo json_encode($labelsKabupaten, 15, 512) ?>;
    const dataProposal = <?php echo json_encode($jumlahProposalPerKabupaten, 15, 512) ?>;
    const labelsJenis = <?php echo json_encode($labelsJenisProposal, 15, 512) ?>;
    const dataJenis = <?php echo json_encode($jumlahPerJenisProposal, 15, 512) ?>;

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>