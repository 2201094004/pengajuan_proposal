<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Dashboard')); ?></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if(auth()->user()->role === 'admin'): ?>
                        <script>
                            window.location.href = "<?php echo e(route('admin.dashboard')); ?>";
                        </script>
                    <?php elseif(auth()->user()->role === 'masyarakat'): ?>
                        <script>
                            window.location.href = "<?php echo e(route('masyarakat.dashboard')); ?>";
                        </script>
                    <?php elseif(auth()->user()->role === 'stakeholder'): ?>
                        <script>
                            window.location.href = "<?php echo e(route('stakeholder.dashboard')); ?>";
                        </script>
                    <?php else: ?>
                        <p><?php echo e(__('Unauthorized access.')); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/home.blade.php ENDPATH**/ ?>