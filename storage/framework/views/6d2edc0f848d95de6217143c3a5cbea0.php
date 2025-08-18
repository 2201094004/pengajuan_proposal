

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header bg-white">
            <h6 class="m-0">Edit Pengguna</h6>
        </div>

        <div class="card-body">
            <form action="<?php echo e(route('admin.update-user', $user->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo e($user->name); ?>" required>
                </div>

                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo e($user->email); ?>" required>
                </div>

                
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="masyarakat" <?php echo e($user->role == 'masyarakat' ? 'selected' : ''); ?>>Masyarakat</option>
                        <option value="admin" <?php echo e($user->role == 'admin' ? 'selected' : ''); ?>>Admin</option>
                        <option value="stakeholder" <?php echo e($user->role == 'stakeholder' ? 'selected' : ''); ?>>Stakeholder</option>
                    </select>
                </div>

                
                <div class="mb-3">
                    <label for="password" class="form-label">Password <small>(Kosongkan jika tidak ingin mengubah)</small></label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                
                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('admin.manage-users')); ?>" class="btn btn-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-success">Update Pengguna</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/admin/edit-user.blade.php ENDPATH**/ ?>