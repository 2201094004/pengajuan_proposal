<!DOCTYPE html>
<html>
<head>
    <title>Data Proposal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h3, p {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-top: 20px;
        }

        thead th, tbody td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        @media print {
            @page {
                size: landscape;
            }
        }
    </style>
</head>
<body>
    <h3>Data Pengajuan Proposal Donasi</h3>
    <p>STAKEHOLDER PT RIAU ANDALAN PULP AND PAPER (RAPP)</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Judul</th>
                <th>Email</th>
                <th>No HP</th>
                <th>No Rekening</th>
                <th>Kabupaten</th>
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
                    <td><?php echo e($proposal->no_hp ?? '-'); ?></td>
                    <td><?php echo e($proposal->no_rekening ?? '-'); ?></td>
                    <td><?php echo e(optional($proposal->kabupaten)->nama ?? '-'); ?></td>
                    <td><?php echo e(ucfirst($proposal->status)); ?></td>
                    <td><?php echo e($proposal->created_at->format('d-m-Y')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH D:\Semester 6\Tugas Akhir TA\Sistem-Pengajuan-Proposal\resources\views/exports/proposals_pdf.blade.php ENDPATH**/ ?>