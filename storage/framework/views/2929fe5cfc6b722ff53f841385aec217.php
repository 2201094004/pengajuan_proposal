

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow-sm" data-aos="fade-up">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pesan Masuk</h5>
        </div>

        <div class="card-body table-responsive">
            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Pesan</th>
                        <th>Waktu</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="text-center"><?php echo e($index + 1); ?></td>
                            <td><?php echo e($contact->name); ?></td>
                            <td><?php echo e($contact->email); ?></td>
                            <td><?php echo e($contact->message); ?></td>
                            <td><?php echo e($contact->created_at->format('d-m-Y H:i')); ?></td>
                            <td class="text-center">
                                <form action="<?php echo e(route('admin.contacts.destroy', $contact->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus pesan ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada pesan masuk.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/admin/contacts/index.blade.php ENDPATH**/ ?>