

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow-sm" data-aos="fade-up">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Kecamatan</h5>
            <a href="<?php echo e(route('admin.kecamatans.create')); ?>" class="btn btn-sm btn-primary">+ Tambah Kecamatan</a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Kecamatan</th>
                        <th>Kabupaten</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $kecamatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kecamatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($kecamatan->nama); ?></td>
                            <td><?php echo e($kecamatan->kabupaten->nama ?? '-'); ?></td>
                            <td class="text-center">
                                <a href="<?php echo e(route('admin.kecamatans.edit', $kecamatan->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                                <form action="<?php echo e(route('admin.kecamatans.destroy', $kecamatan->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus kecamatan ini?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada data kecamatan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
         <?php if(method_exists($kecamatans, 'hasPages') && $kecamatans->hasPages()): ?>
    <nav aria-label="Page navigation example" class="mt-3">
        <ul class="pagination justify-content-center">
            
            <li class="page-item <?php echo e($kecamatans->onFirstPage() ? 'disabled' : ''); ?>">
                <a class="page-link" href="<?php echo e($kecamatans->url(1)); ?>">First</a>
            </li>

            
            <li class="page-item <?php echo e($kecamatans->onFirstPage() ? 'disabled' : ''); ?>">
                <a class="page-link" href="<?php echo e($kecamatans->previousPageUrl() ?? '#'); ?>" aria-label="Previous">«</a>
            </li>

            
            <?php $__currentLoopData = $kecamatans->getUrlRange(1, $kecamatans->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="page-item <?php echo e($page == $kecamatans->currentPage() ? 'active' : ''); ?>">
                    <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <li class="page-item <?php echo e(!$kecamatans->hasMorePages() ? 'disabled' : ''); ?>">
                <a class="page-link" href="<?php echo e($kecamatans->nextPageUrl() ?? '#'); ?>" aria-label="Next">»</a>
            </li>

            
            <li class="page-item <?php echo e(!$kecamatans->hasMorePages() ? 'disabled' : ''); ?>">
                <a class="page-link" href="<?php echo e($kecamatans->url($kecamatans->lastPage())); ?>">Last</a>
            </li>
        </ul>
    </nav>
<?php endif; ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/kecamatans/index.blade.php ENDPATH**/ ?>