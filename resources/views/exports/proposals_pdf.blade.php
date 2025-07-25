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
            @foreach($proposals as $index => $proposal)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $proposal->nama }}</td>
                    <td>{{ $proposal->title }}</td>
                    <td>{{ $proposal->email }}</td>
                    <td>{{ $proposal->no_hp ?? '-' }}</td>
                    <td>{{ $proposal->no_rekening ?? '-' }}</td>
                    <td>{{ optional($proposal->kabupaten)->nama ?? '-' }}</td>
                    <td>{{ ucfirst($proposal->status) }}</td>
                    <td>{{ $proposal->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
