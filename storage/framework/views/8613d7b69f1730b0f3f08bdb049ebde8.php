<div class="sidebar p-3" style="width: 250px; height: auto;">
    <h5 class="text-center mb-4">Menu</h5>

    <div class="list-group list-group-flush">

        
        <?php if(auth()->user()->role === 'masyarakat'): ?>
            <a href="<?php echo e(route('masyarakat.dashboard')); ?>" 
               class="list-group-item list-group-item-action <?php echo e(request()->is('masyarakat') ? 'active' : ''); ?>">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>

            <a href="<?php echo e(route('profile')); ?>" 
               class="list-group-item list-group-item-action <?php echo e(request()->is('profile') ? 'active' : ''); ?>">
                <i class="fas fa-user me-2"></i> Profile
            </a>

            <a href="<?php echo e(route('proposals.index')); ?>" 
               class="list-group-item list-group-item-action <?php echo e(request()->is('proposals*') ? 'active' : ''); ?>">
                <i class="fas fa-book me-2"></i> Proposal
            </a>
        <?php endif; ?>

        
        <?php if(auth()->user()->role === 'admin'): ?>
            <a href="<?php echo e(route('admin.dashboard')); ?>" 
               class="list-group-item list-group-item-action <?php echo e(request()->is('admin') ? 'active' : ''); ?>">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>

            <a href="<?php echo e(route('profile')); ?>" 
               class="list-group-item list-group-item-action <?php echo e(request()->is('profile') ? 'active' : ''); ?>">
                <i class="fas fa-user me-2"></i> Profile
            </a>

            <a href="<?php echo e(route('admin.jenis_proposals.index')); ?>" 
                class="list-group-item list-group-item-action <?php echo e(request()->is('admin/jenis-proposals*') ? 'active' : ''); ?>">
                <i class="fas fa-folder me-2"></i> Jenis Proposal
            </a>

            <a href="<?php echo e(route('proposals.index')); ?>" 
               class="list-group-item list-group-item-action <?php echo e(request()->is('admin/proposals') ? 'active' : ''); ?>">
               <i class="fas fa-book me-2"></i> Semua Proposal
            </a>

            <a href="<?php echo e(route('admin.status-pengajuan')); ?>" 
               class="list-group-item list-group-item-action <?php echo e(request()->is('admin/status-pengajuan') ? 'active' : ''); ?>">
                <i class="fas fa-check-circle me-2"></i> Status Pengajuan
            </a>

             

            <a href="<?php echo e(route('admin.contacts.index')); ?>" 
                class="list-group-item list-group-item-action <?php echo e(request()->is('admin/contacts*') ? 'active' : ''); ?>">
                <i class="fas fa-envelope me-2"></i> Pesan Masuk
            </a>

            <a href="<?php echo e(route('admin.kabupatens.index')); ?>" 
                class="list-group-item list-group-item-action <?php echo e(request()->is('admin/kabupatens*') ? 'active' : ''); ?>">
                <i class="fas fa-map-marker-alt me-2"></i> Kabupaten
            </a>

            <a href="<?php echo e(route('admin.kecamatans.index')); ?>" 
                class="list-group-item list-group-item-action <?php echo e(request()->is('admin/kecamatans*') ? 'active' : ''); ?>">
                <i class="fas fa-map me-2"></i> Kecamatan
            </a>

            <a href="<?php echo e(route('admin.desas.index')); ?>" 
                class="list-group-item list-group-item-action <?php echo e(request()->is('admin/desas*') ? 'active' : ''); ?>">
                <i class="fas fa-map-pin me-2"></i> Desa
            </a>

            <a href="<?php echo e(route('admin.manage-users')); ?>" 
               class="list-group-item list-group-item-action <?php echo e(request()->is('admin/users*') ? 'active' : ''); ?>">
                <i class="fas fa-users me-2"></i> Manajemen Pengguna
            </a>
        <?php endif; ?>

        
        <?php if(auth()->user()->role === 'stakeholder'): ?>
            <a href="<?php echo e(route('stakeholder.dashboard')); ?>" 
               class="list-group-item list-group-item-action <?php echo e(request()->is('stakeholder') ? 'active' : ''); ?>">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>

            <a href="<?php echo e(route('profile')); ?>" 
               class="list-group-item list-group-item-action <?php echo e(request()->is('profile') ? 'active' : ''); ?>">
                <i class="fas fa-user me-2"></i> Profile
            </a>

            <a href="<?php echo e(route('stakeholder.proposals')); ?>" 
                class="list-group-item list-group-item-action <?php echo e(request()->is('stakeholder/proposals*') ? 'active' : ''); ?>">
                <i class="fas fa-book me-2"></i> Semua Proposal
            </a>

            <a href="<?php echo e(route('stakeholder.status-pengajuan')); ?>" 
                class="list-group-item list-group-item-action <?php echo e(request()->is('stakeholder/status-pengajuan') ? 'active' : ''); ?>">
                <i class="fas fa-check-circle me-2"></i> Status Pengajuan
            </a>


            
        <?php endif; ?>

        
        

    </div>
</div>
<?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>