<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h6 class="m-0">Daftar Proposal Anda</h6>
            <a href="<?php echo e(route('proposals.create')); ?>" class="btn btn-sm btn-primary">+ Buat Proposal Baru</a>
        </div>

        <div class="card-body table-responsive">
            <table id="proposalTable" class="table table-bordered table-hover align-middle text-center display nowrap" style="width:100%">
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
                        <th>Dokumen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $proposals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proposal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($proposals->firstItem() + $loop->index); ?></td>
                            <td><?php echo e($proposal->nama); ?></td>
                            <td><?php echo e($proposal->title); ?></td>
                            <td><?php echo e($proposal->email); ?></td>
                            <td><?php echo e($proposal->no_hp); ?></td>
                            <td><?php echo e($proposal->no_rekening); ?></td>
                            <td><?php echo e($proposal->alamat); ?></td>
                            <td>
                                <?php echo e($proposal->kabupaten->nama ?? '-'); ?><br>
                                <small><?php echo e($proposal->kecamatan->nama ?? '-'); ?> / <?php echo e($proposal->desa->nama ?? '-'); ?></small>
                            </td>
                            <td><?php echo e($proposal->kabupatenTujuan->nama ?? '-'); ?></td>
                            <td><?php echo e($proposal->jenisProposal->nama ?? '-'); ?></td>
                            <td>
                                <?php switch($proposal->status):
                                    case ('draft'): ?> <span class="badge bg-warning text-dark">Draft</span> <?php break; ?>
                                    <?php case ('submitted'): ?> <span class="badge bg-primary">Dikirim</span> <?php break; ?>
                                    <?php case ('accepted'): ?> <span class="badge bg-success">Diterima</span> <?php break; ?>
                                    <?php case ('rejected'): ?> <span class="badge bg-danger">Ditolak</span> <?php break; ?>
                                    <?php case ('revised'): ?> <span class="badge bg-info text-dark">Revisi</span> <?php break; ?>
                                    <?php default: ?> <span class="badge bg-secondary">-</span>
                                <?php endswitch; ?>
                            </td>
                            <td>
                                <?php if($proposal->proposal_file): ?>
                                    <a href="<?php echo e(asset('storage/documents/' . $proposal->proposal_file)); ?>" target="_blank" class="btn btn-sm btn-outline-secondary">Lihat</a>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                
                                
                                <?php if($proposal->status == 'draft'): ?>
                                    <form action="<?php echo e(route('proposals.submit', $proposal->id)); ?>" method="POST" class="d-inline"><?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                    </form>
                                <?php endif; ?>
                                
                                <a href="<?php echo e(route('proposals.edit', $proposal->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                                
                                <form action="<?php echo e(route('proposals.destroy', $proposal->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus proposal ini?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="12" class="text-center text-muted">Belum ada proposal yang dibuat.</td></tr>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script>
    $(document).ready(function () {
        $('#proposalTable').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: ['csv', 'excel', 'pdf', 'print'],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "›",
                    previous: "‹"
                },
                emptyTable: "Belum ada data proposal."
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/proposals/index.blade.php ENDPATH**/ ?>