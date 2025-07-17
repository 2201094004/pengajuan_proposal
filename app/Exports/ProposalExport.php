<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

// class ProposalExport implements FromCollection, WithHeadings
// {
//     protected $proposals;

//     // public function __construct(Collection $proposals)
    // {
    //     $this->proposals = $proposals;
    // }

    // public function collection()
    // {
    //     // return hanya data yang dibutuhkan
    //     return $this->proposals->map(function ($item) {
    //         return [
    //             'judul' => $item->judul,
    //             'pengusul' => $item->user->name ?? '-',
    //             'created_at' => $item->created_at->format('Y-m-d H:i:s'),
    //             'status' => $item->status,
    //         ];
    //     });
    // }

    // public function headings(): array
    // {
    //     return ['Judul', 'Pengusul', 'Tanggal Dibuat', 'Status'];
    // }
// }
