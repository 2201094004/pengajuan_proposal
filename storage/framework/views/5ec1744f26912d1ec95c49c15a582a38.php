

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header bg-white">
            <h6 class="m-0">Tambah Kecamatan</h6>
        </div>

        <div class="card-body">
            <form action="<?php echo e(route('admin.kecamatans.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Kecamatan</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>

                
                <div class="mb-3">
                    <label for="kabupaten_id" class="form-label">Kabupaten</label>
                    <select class="form-select" id="kabupaten_id" name="kabupaten_id" required>
                        <option value="">-- Pilih Kabupaten --</option>
                        <?php $__currentLoopData = $kabupatens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kabupaten): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($kabupaten->id); ?>"><?php echo e($kabupaten->nama); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('admin.kecamatans.index')); ?>" class="btn btn-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Kecamatan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/kecamatans/create.blade.php ENDPATH**/ ?>