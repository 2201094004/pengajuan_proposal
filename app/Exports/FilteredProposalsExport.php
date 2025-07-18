<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FilteredProposalsExport implements FromCollection, WithHeadings
{
    protected $proposals;

    public function __construct(Collection $proposals)
    {
        $this->proposals = $proposals;
    }

    public function collection()
    {
        return $this->proposals->map(function ($p) {
            return [
                'Nama' => $p->nama,
                'Judul' => $p->title,
                'Email' => $p->email,
                'No HP' => $p->no_hp,
                'No Rekening' => $p->no_rekening,
                'Alamat' => $p->alamat,
                'Kabupaten' => optional($p->kabupaten)->nama,
                'Kecamatan' => optional($p->kecamatan)->nama,
                'Desa' => optional($p->desa)->nama,
                'Kabupaten Tujuan' => $p->kabupaten_tujuan ?? '-',
                'Status' => ucfirst($p->status),
                'Tanggal' => $p->created_at->format('d-m-Y'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Judul',
            'Email',
            'No HP',
            'No Rekening',
            'Alamat',
            'Kabupaten',
            'Kecamatan',
            'Desa',
            'Kabupaten Tujuan',
            'Status',
            'Tanggal',
        ];
    }
}
