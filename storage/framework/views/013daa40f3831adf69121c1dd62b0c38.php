<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header bg-white">
            <h6 class="m-0">Edit Proposal</h6>
        </div>

        <div class="card-body">
            <form action="<?php echo e(route('proposals.update', $proposal->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo e($proposal->nama); ?>" required>
                </div>

                
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Proposal</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo e($proposal->title); ?>" required>
                </div>

                
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required><?php echo e($proposal->description); ?></textarea>
                </div>

                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo e($proposal->email); ?>" required>
                </div>

                
                <div class="mb-3">
                    <label for="no_hp" class="form-label">No HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo e($proposal->no_hp); ?>" required>
                </div>

                
                <div class="mb-3">
                    <label for="no_rekening" class="form-label">No Rekening</label>
                    <input type="text" class="form-control" id="no_rekening" name="no_rekening" value="<?php echo e($proposal->no_rekening); ?>" required>
                </div>

                
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="2" required><?php echo e($proposal->alamat); ?></textarea>
                </div>

                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="kabupaten_id" class="form-label">Kabupaten</label>
                        <select class="form-select" name="kabupaten_id" id="kabupaten_id" required>
                            <option value="">-- Pilih Kabupaten --</option>
                            <?php $__currentLoopData = $kabupatens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($kab->id); ?>" <?php echo e($proposal->kabupaten_id == $kab->id ? 'selected' : ''); ?>><?php echo e($kab->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="kecamatan_id" class="form-label">Kecamatan</label>
                        <select class="form-select" name="kecamatan_id" id="kecamatan_id">
                            <option value="">-- Pilih Kecamatan --</option>
                            <?php $__currentLoopData = $kecamatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($kec->id); ?>" <?php echo e($proposal->kecamatan_id == $kec->id ? 'selected' : ''); ?>><?php echo e($kec->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="desa_id" class="form-label">Desa</label>
                        <select class="form-select" name="desa_id" id="desa_id">
                            <option value="">-- Pilih Desa --</option>
                            <?php $__currentLoopData = $desas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $des): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($des->id); ?>" <?php echo e($proposal->desa_id == $des->id ? 'selected' : ''); ?>><?php echo e($des->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                
                <div class="mb-3">
                    <label for="kabupaten_tujuan_id" class="form-label">Kabupaten Tujuan</label>
                    <select name="kabupaten_tujuan_id" class="form-control" id="kabupaten_tujuan_id">
                        <option value="">-- Pilih Kabupaten Tujuan --</option>
                        <?php $__currentLoopData = $kabupatens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kabupaten): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($kabupaten->id); ?>" 
                                <?php echo e($proposal->kabupaten_tujuan_id == $kabupaten->id ? 'selected' : ''); ?>>
                                <?php echo e($kabupaten->nama); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                


                </div>

                
                <div class="mb-3">
                    <label for="jenis_proposal_id" class="form-label">Jenis Proposal</label>
                    <select name="jenis_proposal_id" id="jenis_proposal_id" class="form-select" required>
                        <option value="">-- Pilih Jenis Proposal --</option>
                        <?php $__currentLoopData = $jenisProposals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($jenis->id); ?>" <?php echo e($proposal->jenis_proposal_id == $jenis->id ? 'selected' : ''); ?>>
                                <?php echo e($jenis->nama); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div class="mb-3">
                    <label for="document" class="form-label">Dokumen Baru (Opsional)</label>
                    <input type="file" class="form-control" id="document" name="document" accept="application/pdf">
                    <?php if($proposal->document): ?>
                        <small class="form-text text-muted">
                            Dokumen saat ini: <a href="<?php echo e(asset('storage/documents/' . $proposal->document)); ?>" target="_blank">Lihat</a>
                        </small>
                    <?php endif; ?>
                </div>

                
                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(route('proposals.index')); ?>" class="btn btn-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-warning">Update Proposal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/proposals/edit.blade.php ENDPATH**/ ?>