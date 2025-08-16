<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-down">
        <div class="card-header bg-gradient-primary text-black">
            <h3 class="mb-0">Selamat Datang di Dashboard Masyarakat</h3>
        </div>
        <div class="card-body">
            <p class="lead">Halo, <strong><?php echo e(auth()->user()->name); ?></strong>! Anda login sebagai <strong><?php echo e(auth()->user()->role); ?></strong>.</p>
            <p>Silakan ajukan proposal bantuan melalui sistem ini.</p>

            <a href="<?php echo e(route('proposals.create')); ?>" class="btn btn-success btn-lg mt-3 animate__animated animate__pulse animate__infinite">Ajukan Proposal Sekarang</a>
        </div>
    </div>

    <div class="card shadow-sm" data-aos="fade-up">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Tata Cara Pengisian Proposal</h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Nama:</strong> Isi dengan nama lengkap pengaju proposal.</li>
                <li class="list-group-item"><strong>Judul:</strong> Tulis judul kegiatan atau bantuan yang diajukan.</li>
                <li class="list-group-item"><strong>Email & No HP:</strong> Data kontak yang aktif untuk keperluan verifikasi.</li>
                <li class="list-group-item"><strong>No Rekening:</strong> Pastikan nomor rekening valid untuk pencairan dana.</li>
                <li class="list-group-item"><strong>Alamat:</strong> Isi dengan alamat lengkap Anda.</li>
                <li class="list-group-item"><strong>Asal (Kab/Kec/Desa):</strong> Tuliskan asal wilayah Anda.</li>
                <li class="list-group-item"><strong>Tujuan Kabupaten:</strong> Pilih kabupaten tujuan penyaluran proposal.</li>
                <li class="list-group-item"><strong>Jenis Proposal:</strong> Misalnya bantuan pendidikan, kegiatan sosial, infrastruktur, dll.</li>
                <li class="list-group-item"><strong>Dokumen:</strong> Unggah dokumen pendukung seperti proposal lengkap (PDF), surat permohonan, dll.</li>
            </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/masyarakat/dashboard.blade.php ENDPATH**/ ?>