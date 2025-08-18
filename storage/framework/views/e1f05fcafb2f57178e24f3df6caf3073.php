

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header bg-white">
            <h6 class="m-0">Edit Jenis Proposal</h6>
        </div>

        <div class="card-body">
            <form action="<?php echo e(route('admin.jenis_proposals.update', $jenisProposal->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Jenis Proposal</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo e($jenisProposal->nama); ?>" required>
                </div>

                
                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('admin.jenis_proposals.index')); ?>" class="btn btn-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-success">Update Jenis Proposal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/jenis_proposals/edit.blade.php ENDPATH**/ ?>