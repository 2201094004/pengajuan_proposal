@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4" data-aos="fade-up">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h6 class="m-0">Daftar Proposal Anda</h6>
            <a href="{{ route('proposals.create') }}" class="btn btn-sm btn-primary">+ Buat Proposal Baru</a>
        </div>

        <div class="card-body table-responsive">
            <table id="proposalTable" class="table table-bordered table-hover align-middle text-center display nowrap" style="width:100%">
                <thead class="table-light">
                    <tr>
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
                        <th>Dokumen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($proposals as $proposal)
                        <tr>
                            <td>{{ $proposal->nama }}</td>
                            <td>{{ $proposal->title }}</td>
                            <td>{{ $proposal->email }}</td>
                            <td>{{ $proposal->no_hp }}</td>
                            <td>{{ $proposal->no_rekening }}</td>
                            <td>{{ $proposal->alamat }}</td>
                            <td>
                                {{ $proposal->kabupaten->nama ?? '-' }}<br>
                                <small>{{ $proposal->kecamatan->nama ?? '-' }} / {{ $proposal->desa->nama ?? '-' }}</small>
                            </td>
                            <td>{{ $proposal->kabupatenTujuan->nama ?? '-' }}</td>
                            <td>{{ $proposal->jenisProposal->nama ?? '-' }}</td>
                            <td>
                                @switch($proposal->status)
                                    @case('draft') <span class="badge bg-warning text-dark">Draft</span> @break
                                    @case('submitted') <span class="badge bg-primary">Dikirim</span> @break
                                    @case('accepted') <span class="badge bg-success">Diterima</span> @break
                                    @case('rejected') <span class="badge bg-danger">Ditolak</span> @break
                                    @case('revised') <span class="badge bg-info text-dark">Revisi</span> @break
                                    @default <span class="badge bg-secondary">-</span>
                                @endswitch
                            </td>
                            <td>
                                @if($proposal->proposal_file)
                                    <a href="{{ asset('storage/documents/' . $proposal->proposal_file) }}" target="_blank" class="btn btn-sm btn-outline-secondary">Lihat</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                {{-- <a href="{{ route('proposals.show', $proposal->id) }}" class="btn btn-info btn-sm">Lihat</a> --}}
                                
                                @if($proposal->status == 'draft')
                                    <form action="{{ route('proposals.submit', $proposal->id) }}" method="POST" class="d-inline">@csrf
                                        <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                    </form>
                                @endif
                                
                                <a href="{{ route('proposals.edit', $proposal->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                
                                <form action="{{ route('proposals.destroy', $proposal->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus proposal ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="12" class="text-center text-muted">Belum ada proposal yang dibuat.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script>
    $(document).ready(function () {
        $('#proposalTable').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: ['csv', 'excel', 'pdf', 'print'],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "›",
                    previous: "‹"
                },
                emptyTable: "Belum ada data proposal."
            }
        });
    });
</script>
@endpush
