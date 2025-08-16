<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow p-4" style="width: 400px;">
            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div class="text-center">
                <img src="<?php echo e(asset('images/logorapp.png')); ?>" alt="Logo RAPP" width="200" height="100">
            </div>
            <h3 class="text-center mb-4">Login</h3>
            <form action="<?php echo e(route('login')); ?>" method="POST">
                <?php echo csrf_field(); ?> <!-- CSRF token untuk proteksi -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

            <div class="text-center mt-3">
                <a href="<?php echo e(route('register')); ?>">Don't have an account? Register</a>
            </div>

            <div class="text-center mt-2">
                <a href="<?php echo e(url('/landing')); ?>" class="btn btn-outline-secondary btn-sm">
                    ← Kembali ke Halaman Utama
                </a>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/auth/login.blade.php ENDPATH**/ ?>