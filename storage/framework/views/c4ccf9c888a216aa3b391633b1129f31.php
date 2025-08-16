<!-- Tambahkan SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .navbar-large {
        padding: 1.5rem 1rem;
        font-size: 1.25rem;
    }
    .navbar-large .navbar-brand {
        font-size: 1.5rem;
    }
    .navbar-large img {
        width: 50px;
        height: 50px;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-large">
    <div class="container-fluid">
        <img src="<?php echo e(asset('images/logorapp.png')); ?>" alt="Logo Stmik" class="me-2">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <form id="logoutForm" action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button type="button" class="btn btn-danger btn-sm" id="logoutBtn">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- SweetAlert untuk konfirmasi logout -->
<script>
    document.getElementById('logoutBtn').addEventListener('click', function(e) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    });
</script>

<!-- SweetAlert untuk notifikasi sukses -->
<?php if(session('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: '<?php echo e(session('success')); ?>',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
<?php endif; ?>
<?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/partials/topbar.blade.php ENDPATH**/ ?>