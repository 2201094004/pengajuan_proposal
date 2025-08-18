<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">

        
        <div class="card-header bg-white">
            <h5 class="mb-3">Status Pengajuan Proposal</h5>

            <div class="row g-3">
                
                <div class="col-md-4">
                    <label for="kabupaten_id" class="form-label">Filter Kabupaten</label>
                    <select name="kabupaten_id" id="kabupaten_id" class="form-select">
                        <option value="">-- Semua Kabupaten --</option>
                        <?php $__currentLoopData = $kabupatens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($kab->id); ?>" <?php echo e(request('kabupaten_id') == $kab->id ? 'selected' : ''); ?>>
                                <?php echo e($kab->nama); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div class="col-md-8 d-flex align-items-end justify-content-md-end">
                    <form action="#" method="GET" class="d-flex align-items-center flex-wrap">
                        
                        <select name="range" class="form-select form-select-sm me-2 mb-2" style="max-width: 180px;">
                            <option value="daily"   <?php echo e(request('range') == 'daily' ? 'selected' : ''); ?>>Harian</option>
                            <option value="weekly"  <?php echo e(request('range') == 'weekly' ? 'selected' : ''); ?>>Mingguan</option>
                            <option value="monthly" <?php echo e(request('range') == 'monthly' ? 'selected' : ''); ?>>Bulanan</option>
                            <option value="yearly"  <?php echo e(request('range') == 'yearly' ? 'selected' : ''); ?>>Tahunan</option>
                        </select>

                        
                        <a href="<?php echo e(route('admin.proposals.export.excel', ['range' => request('range','daily'), 'search' => request('search')])); ?>"
                           class="btn btn-sm btn-success me-2 mb-2">
                            <i class="fas fa-file-excel"></i> Excel
                        </a>
                        <a href="<?php echo e(route('admin.proposals.export.pdf', ['range' => request('range','daily'), 'search' => request('search')])); ?>"
                           class="btn btn-sm btn-danger mb-2">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                    </form>
                </div>
            </div>
        </div>

        
        <div class="card-body">
            
            <form method="GET" action="<?php echo e(route('admin.status-pengajuan')); ?>" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama atau judul..." value="<?php echo e(request('search')); ?>">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </form>

            
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Judul</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>No Rekening</th>
                            <th>Alamat</th>
                            <th>Asal (Kab/Kec/Desa)</th>
                            <th>Tujuan Kabupaten</th>
                            <th>Jenis Proposal</th>
                            <th>Status</th>
                            <th>Diverifikasi Oleh</th> 
                            <th>Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $proposals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $proposal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                
                                <td>
                                    <?php echo e(method_exists($proposals, 'firstItem') ? $proposals->firstItem() + $index : $loop->iteration); ?>

                                </td>

                                <td><?php echo e($proposal->nama); ?></td>
                                <td><?php echo e($proposal->title); ?></td>
                                <td><?php echo e($proposal->email); ?></td>
                                <td><?php echo e($proposal->no_hp); ?></td>
                                <td><?php echo e($proposal->no_rekening); ?></td>
                                <td><?php echo e($proposal->alamat); ?></td>
                                <td>
                                    <?php echo e(optional($proposal->kabupaten)->nama ?? '-'); ?><br>
                                    <small><?php echo e(optional($proposal->kecamatan)->nama ?? '-'); ?> / <?php echo e(optional($proposal->desa)->nama ?? '-'); ?></small>
                                </td>
                                <td><?php echo e(optional($proposal->kabupatenTujuan)->nama ?? '-'); ?></td>
                                <td><?php echo e(optional($proposal->jenisProposal)->nama ?? '-'); ?></td>
                                <td>
                                    <?php switch($proposal->status):
                                        case ('draft'): ?>     <span class="badge bg-warning text-dark">Draft</span> <?php break; ?>
                                        <?php case ('submitted'): ?> <span class="badge bg-primary">Dikirim</span> <?php break; ?>
                                        <?php case ('accepted'): ?>  <span class="badge bg-success">Diterima</span> <?php break; ?>
                                        <?php case ('rejected'): ?>  <span class="badge bg-danger">Ditolak</span> <?php break; ?>
                                        <?php case ('revised'): ?>   <span class="badge bg-info text-dark">Revisi</span> <?php break; ?>
                                        <?php default: ?>           <span class="badge bg-secondary">-</span>
                                    <?php endswitch; ?>
                                </td>
                                <td>
                                    <?php if($proposal->verifier): ?>
                                        <?php if($proposal->verifier->role == 'admin'): ?>
                                            Admin
                                        <?php elseif($proposal->verifier->role == 'stakeholder'): ?>
                                            Stakeholder <?php echo e(optional($proposal->verifier->kabupaten)->nama ?? '-'); ?>

                                        <?php else: ?>
                                            <?php echo e($proposal->verifier->name); ?>

                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="text-muted">Belum diverifikasi</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($proposal->proposal_file): ?>
                                        <a href="<?php echo e(asset('storage/documents/'.$proposal->proposal_file)); ?>" target="_blank" class="btn btn-sm btn-outline-secondary">
                                            Lihat
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('admin.proposals.penilaian', $proposal->id)); ?>" class="btn btn-sm btn-info mb-1" target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <?php if($proposal->status === 'submitted'): ?>
                                        <form action="<?php echo e(route('admin.proposal.accept', $proposal->id)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button class="btn btn-sm btn-success">✓ Terima</button>
                                        </form>
                                        <form action="<?php echo e(route('admin.proposal.reject', $proposal->id)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button class="btn btn-sm btn-danger">× Tolak</button>
                                        </form>
                                        
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="14" class="text-center text-muted">Belum ada pengajuan proposal.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <?php if(method_exists($proposals, 'hasPages') && $proposals->hasPages()): ?>
            <nav aria-label="Page navigation example" class="mt-3">
                <ul class="pagination justify-content-center">
                    
                    <li class="page-item <?php echo e($proposals->onFirstPage() ? 'disabled' : ''); ?>">
                        <a class="page-link" href="<?php echo e($proposals->url(1)); ?>">First</a>
                    </li>

                    
                    <li class="page-item <?php echo e($proposals->onFirstPage() ? 'disabled' : ''); ?>">
                        <a class="page-link" href="<?php echo e($proposals->previousPageUrl() ?? '#'); ?>" aria-label="Previous">«</a>
                    </li>

                    
                    <?php $__currentLoopData = $proposals->getUrlRange(1, $proposals->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="page-item <?php echo e($page == $proposals->currentPage() ? 'active' : ''); ?>">
                            <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
                    <li class="page-item <?php echo e(!$proposals->hasMorePages() ? 'disabled' : ''); ?>">
                        <a class="page-link" href="<?php echo e($proposals->nextPageUrl() ?? '#'); ?>" aria-label="Next">»</a>
                    </li>

                    
                    <li class="page-item <?php echo e(!$proposals->hasMorePages() ? 'disabled' : ''); ?>">
                        <a class="page-link" href="<?php echo e($proposals->url($proposals->lastPage())); ?>">Last</a>
                    </li>
                </ul>
            </nav>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/admin/status-pengajuan.blade.php ENDPATH**/ ?>