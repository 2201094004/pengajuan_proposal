

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow-sm" data-aos="fade-up">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Jenis Proposal</h5>
            <a href="<?php echo e(route('admin.jenis_proposals.create')); ?>" class="btn btn-sm btn-primary">+ Tambah Jenis</a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Jenis Proposal</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $jenisProposals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($jenis->nama); ?></td>
                            <td class="text-center">
                                <a href="<?php echo e(route('admin.jenis_proposals.edit', $jenis->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                                <form action="<?php echo e(route('admin.jenis_proposals.destroy', $jenis->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus jenis proposal ini?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">Belum ada data jenis proposal.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
         <?php if(method_exists($jenisProposals, 'hasPages') && $jenisProposals->hasPages()): ?>
    <nav aria-label="Page navigation example" class="mt-3">
        <ul class="pagination justify-content-center">
            
            <li class="page-item <?php echo e($jenisProposals->onFirstPage() ? 'disabled' : ''); ?>">
                <a class="page-link" href="<?php echo e($jenisProposals->url(1)); ?>">First</a>
            </li>

            
            <li class="page-item <?php echo e($jenisProposals->onFirstPage() ? 'disabled' : ''); ?>">
                <a class="page-link" href="<?php echo e($jenisProposals->previousPageUrl() ?? '#'); ?>" aria-label="Previous">«</a>
            </li>

            
            <?php $__currentLoopData = $jenisProposals->getUrlRange(1, $jenisProposals->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="page-item <?php echo e($page == $jenisProposals->currentPage() ? 'active' : ''); ?>">
                    <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <li class="page-item <?php echo e(!$jenisProposals->hasMorePages() ? 'disabled' : ''); ?>">
                <a class="page-link" href="<?php echo e($jenisProposals->nextPageUrl() ?? '#'); ?>" aria-label="Next">»</a>
            </li>

            
            <li class="page-item <?php echo e(!$jenisProposals->hasMorePages() ? 'disabled' : ''); ?>">
                <a class="page-link" href="<?php echo e($jenisProposals->url($jenisProposals->lastPage())); ?>">Last</a>
            </li>
        </ul>
    </nav>
<?php endif; ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/jenis_proposals/index.blade.php ENDPATH**/ ?>