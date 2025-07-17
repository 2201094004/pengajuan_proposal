<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FilteredProposalsExport implements FromCollection, WithHeadings, WithStyles
{
    protected $proposals;

    public function __construct($proposals)
    {
        $this->proposals = $proposals;
    }

    public function collection()
    {
        return $this->proposals->map(function ($proposal) {
            return [
                'ID' => $proposal->id,
                'Judul Proposal' => $proposal->title,
                'Email' => $proposal->email,
                'No HP' => $proposal->no_hp,
                'No Rekening' => $proposal->no_rekening,
                'Status' => ucfirst($proposal->status),
                'Tanggal Dibuat' => $proposal->created_at->format('Y-m-d'),
                'Tanggal Diperbarui' => $proposal->updated_at->format('Y-m-d H:i:s'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Judul Proposal',
            'Email',
            'No HP',
            'No Rekening',
            'Status',
            'Tanggal Dibuat',
            'Tanggal Diperbarui',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $rowCount = $this->proposals->count() + 1; // +1 for header row

        $sheet->getStyle('A1:H' . $rowCount)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'font' => [
                'name' => 'Calibri',
                'size' => 11,
            ],
        ]);

        // Bold header row
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);

        return [];
    }
}
