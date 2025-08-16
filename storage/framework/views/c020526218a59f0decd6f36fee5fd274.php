<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <style>
        body {
            background: linear-gradient(to right, #ffffff, #ffffff);
        }
        .navbar {
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .sidebar {
            background-color: #fff;
            color: #333;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            height: 100vh;
        }
        .sidebar a {
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar a.active, .sidebar a:hover {
            background: #2d8dc5;
            color: #fff;
        }
    </style>
</head>
<body>
<div id="app">
    <!-- Top Bar -->
    <?php echo $__env->make('partials.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="d-flex">
        <!-- Sidebar -->
        <?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Main Content -->
        <div class="container-fluid p-4" style="flex-grow: 1;">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery & DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('.datatable').DataTable({
            paging: false,   // biar pagination Laravel yang jalan
            info: false,     // hilangin "Showing X of Y"
            searching: true, // search aktif
            ordering: true,  // sorting aktif
            responsive: true,
            language: {
                search: "Cari:",
                zeroRecords: "Data tidak ditemukan",
            }
        });
    });

    // SweetAlert Notifikasi
    <?php if(session('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?php echo e(session('success')); ?>',
            timer: 2500,
            showConfirmButton: false,
            timerProgressBar: true,
        });
    <?php endif; ?>

    <?php if(session('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '<?php echo e(session('error')); ?>',
            timer: 2500,
            showConfirmButton: false,
            timerProgressBar: true,
        });
    <?php endif; ?>
</script>

<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/layouts/app.blade.php ENDPATH**/ ?>