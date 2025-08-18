<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <h3 style="text-align: center;">Data Pengajuan Proposal Donasi</h3>
    <h5 style="text-align: center;">STAKEHOLDER PT RIAU ANDALAN PULP AND PAPER (RAPP)</h5>

    <table>
        <thead>
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
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $proposals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $proposal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($proposal->nama); ?></td>
                    <td><?php echo e($proposal->title); ?></td>
                    <td><?php echo e($proposal->email); ?></td>
                    <td><?php echo e($proposal->no_hp); ?></td>
                    <td><?php echo e($proposal->no_rekening); ?></td>
                    <td><?php echo e($proposal->alamat); ?></td>
                    <td>
                        <?php echo e($proposal->kabupaten->nama ?? '-'); ?> /
                        <?php echo e($proposal->kecamatan->nama ?? '-'); ?> /
                        <?php echo e($proposal->desa->nama ?? '-'); ?>

                    </td>
                    <td><?php echo e($proposal->kabupatenTujuan->nama ?? '-'); ?></td>
                    <td><?php echo e($proposal->jenisProposal->nama ?? '-'); ?></td>
                    <td><?php echo e(ucfirst($proposal->status)); ?></td>
                    <td><?php echo e($proposal->created_at->format('d-m-Y')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/exports/proposals_excel.blade.php ENDPATH**/ ?>