

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header bg-white">
            <h6 class="m-0">Tambah Kabupaten</h6>
        </div>

        <div class="card-body">
            <form action="<?php echo e(route('admin.kabupatens.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Kabupaten</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>

                
                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('admin.kabupatens.index')); ?>" class="btn btn-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Kabupaten</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/kabupatens/create.blade.php ENDPATH**/ ?>