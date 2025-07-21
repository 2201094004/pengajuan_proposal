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
            @foreach($proposals as $index => $proposal)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $proposal->nama }}</td>
                    <td>{{ $proposal->title }}</td>
                    <td>{{ $proposal->email }}</td>
                    <td>{{ $proposal->no_hp }}</td>
                    <td>{{ $proposal->no_rekening }}</td>
                    <td>{{ $proposal->alamat }}</td>
                    <td>
                        {{ $proposal->kabupaten->nama ?? '-' }} /
                        {{ $proposal->kecamatan->nama ?? '-' }} /
                        {{ $proposal->desa->nama ?? '-' }}
                    </td>
                    <td>{{ $proposal->kabupatenTujuan->nama ?? '-' }}</td>
                    <td>{{ $proposal->jenisProposal->nama ?? '-' }}</td>
                    <td>{{ ucfirst($proposal->status) }}</td>
                    <td>{{ $proposal->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
