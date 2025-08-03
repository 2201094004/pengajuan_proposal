<div class="sidebar p-3" style="width: 250px; height: auto;">
    <h5 class="text-center mb-4">Menu</h5>

    <div class="list-group list-group-flush">

        {{-- Sidebar untuk Masyarakat --}}
        @if(auth()->user()->role === 'masyarakat')
            <a href="{{ route('masyarakat.dashboard') }}" 
               class="list-group-item list-group-item-action {{ request()->is('masyarakat') ? 'active' : '' }}">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>

            <a href="{{ route('profile') }}" 
               class="list-group-item list-group-item-action {{ request()->is('profile') ? 'active' : '' }}">
                <i class="fas fa-user me-2"></i> Profile
            </a>

            <a href="{{ route('proposals.index') }}" 
               class="list-group-item list-group-item-action {{ request()->is('proposals*') ? 'active' : '' }}">
                <i class="fas fa-book me-2"></i> Proposal
            </a>
        @endif

        {{-- Sidebar untuk Admin --}}
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" 
               class="list-group-item list-group-item-action {{ request()->is('admin') ? 'active' : '' }}">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>

            <a href="{{ route('profile') }}" 
               class="list-group-item list-group-item-action {{ request()->is('profile') ? 'active' : '' }}">
                <i class="fas fa-user me-2"></i> Profile
            </a>

            <a href="{{ route('admin.jenis_proposals.index') }}" 
                class="list-group-item list-group-item-action {{ request()->is('admin/jenis-proposals*') ? 'active' : '' }}">
                <i class="fas fa-folder me-2"></i> Jenis Proposal
            </a>

            <a href="{{ route('proposals.index') }}" 
               class="list-group-item list-group-item-action {{ request()->is('admin/proposals') ? 'active' : '' }}">
               <i class="fas fa-book me-2"></i> Semua Proposal
            </a>

            <a href="{{ route('admin.status-pengajuan') }}" 
               class="list-group-item list-group-item-action {{ request()->is('admin/status-pengajuan') ? 'active' : '' }}">
                <i class="fas fa-check-circle me-2"></i> Status Pengajuan
            </a>

             {{-- <a href="{{ route('stakeholder.evaluate') }}" 
               class="list-group-item list-group-item-action {{ request()->is('stakeholder/evaluate*') ? 'active' : '' }}">
                <i class="fas fa-tasks me-2"></i> Evaluasi Proposal
            </a>

            <a href="{{ route('stakeholder.history') }}" 
               class="list-group-item list-group-item-action {{ request()->is('stakeholder/history*') ? 'active' : '' }}">
                <i class="fas fa-history me-2"></i> Riwayat Evaluasi
            </a> --}}

            <a href="{{ route('admin.contacts.index') }}" 
                class="list-group-item list-group-item-action {{ request()->is('admin/contacts*') ? 'active' : '' }}">
                <i class="fas fa-envelope me-2"></i> Pesan Masuk
            </a>

            <a href="{{ route('admin.kabupatens.index') }}" 
                class="list-group-item list-group-item-action {{ request()->is('admin/kabupatens*') ? 'active' : '' }}">
                <i class="fas fa-map-marker-alt me-2"></i> Kabupaten
            </a>

            <a href="{{ route('admin.kecamatans.index') }}" 
                class="list-group-item list-group-item-action {{ request()->is('admin/kecamatans*') ? 'active' : '' }}">
                <i class="fas fa-map me-2"></i> Kecamatan
            </a>

            <a href="{{ route('admin.desas.index') }}" 
                class="list-group-item list-group-item-action {{ request()->is('admin/desas*') ? 'active' : '' }}">
                <i class="fas fa-map-pin me-2"></i> Desa
            </a>

            <a href="{{ route('admin.manage-users') }}" 
               class="list-group-item list-group-item-action {{ request()->is('admin/users*') ? 'active' : '' }}">
                <i class="fas fa-users me-2"></i> Manajemen Pengguna
            </a>
        @endif

        {{-- Sidebar untuk Stakeholder --}}
        @if(auth()->user()->role === 'stakeholder')
            <a href="{{ route('stakeholder.dashboard') }}" 
               class="list-group-item list-group-item-action {{ request()->is('stakeholder') ? 'active' : '' }}">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>

            <a href="{{ route('profile') }}" 
               class="list-group-item list-group-item-action {{ request()->is('profile') ? 'active' : '' }}">
                <i class="fas fa-user me-2"></i> Profile
            </a>

            <a href="{{ route('stakeholder.proposals') }}" 
                class="list-group-item list-group-item-action {{ request()->is('stakeholder/proposals*') ? 'active' : '' }}">
                <i class="fas fa-book me-2"></i> Semua Proposal
            </a>

            <a href="{{ route('stakeholder.status-pengajuan') }}" 
                class="list-group-item list-group-item-action {{ request()->is('stakeholder/status-pengajuan') ? 'active' : '' }}">
                <i class="fas fa-check-circle me-2"></i> Status Pengajuan
            </a>


            {{-- <a href="{{ route('stakeholder.evaluate') }}" 
               class="list-group-item list-group-item-action {{ request()->is('stakeholder/evaluate*') ? 'active' : '' }}">
                <i class="fas fa-tasks me-2"></i> Evaluasi Proposal
            </a>

            <a href="{{ route('stakeholder.history') }}" 
               class="list-group-item list-group-item-action {{ request()->is('stakeholder/history*') ? 'active' : '' }}">
                <i class="fas fa-history me-2"></i> Riwayat Evaluasi
            </a> --}}
        @endif

        {{-- Logout --}}
        {{-- <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="list-group-item list-group-item-action text-start">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
        </form> --}}

    </div>
</div>
