<table style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th style="border: 1px solid #000; padding: 5px;">ID</th>
            <th style="border: 1px solid #000; padding: 5px;">Judul Proposal</th>
            <th style="border: 1px solid #000; padding: 5px;">Email</th>
            <th style="border: 1px solid #000; padding: 5px;">No HP</th>
            <th style="border: 1px solid #000; padding: 5px;">No Rekening</th>
            <th style="border: 1px solid #000; padding: 5px;">Status</th>
            <th style="border: 1px solid #000; padding: 5px;">Tanggal Dibuat</th>
            <th style="border: 1px solid #000; padding: 5px;">Tanggal Diperbarui</th>
        </tr>
    </thead>
    <tbody>
        @foreach($proposals as $proposal)
        <tr>
            <td style="border: 1px solid #000; padding: 5px;">{{ $proposal->id }}</td>
            <td style="border: 1px solid #000; padding: 5px;">{{ $proposal->title }}</td>
            <td style="border: 1px solid #000; padding: 5px;">{{ $proposal->email }}</td>
            <td style="border: 1px solid #000; padding: 5px;">{{ $proposal->no_hp }}</td>
            <td style="border: 1px solid #000; padding: 5px;">{{ $proposal->no_rekening }}</td>
            <td style="border: 1px solid #000; padding: 5px;">{{ ucfirst($proposal->status) }}</td>
            <td style="border: 1px solid #000; padding: 5px;">{{ $proposal->created_at->format('Y-m-d') }}</td>
            <td style="border: 1px solid #000; padding: 5px;">{{ $proposal->updated_at->format('Y-m-d H:i:s') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
