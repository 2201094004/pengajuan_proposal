<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Your Profile</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" value="<?php echo e($user->name); ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" value="<?php echo e($user->email); ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <input type="text" class="form-control" value="<?php echo e(ucfirst($user->role)); ?>" disabled>
            </div>

            <div class="d-flex justify-content-end">
                <a href="<?php echo e(route('profile.edit')); ?>" class="btn btn-warning">Edit Profile</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/profile/index.blade.php ENDPATH**/ ?>