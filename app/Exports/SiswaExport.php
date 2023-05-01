<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class SiswaExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $request;
    protected $data;
    protected $number = 0;

    public function __construct($request)
    {
        $this->request = $request;
        $this->data = Siswa::with('tahunAjaran', 'jurusan')->where(function ($query) {
            if ($this->request->tahun_ajaran != 'Semua') {
                $query->where('tahun_ajaran_id', $this->request->tahun_ajaran);
            }

            if ($this->request->jurusan != 'Semua') {
                $query->where('jurusan_id', $this->request->jurusan);
            }
        })->get();
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'NO',
            'NIS',
            'NISN',
            'NAMA SISWA',
            'JENIS KELAMIN',
            'TAHUN AJARAN',
            'JURUSAN',
            'STATUS'
        ];
    }

    public function map($row): array
    {
        return [
            ++$this->number,
            $row->nis,
            $row->nisn,
            $row->nama_siswa,
            $row->jenis_kelamin,
            $row->tahunAjaran->tahun_ajaran,
            $row->jurusan->nama_jurusan,
            $row->status_kelulusan == null ? 'Belum Ditentukan' : ($row->status_kelulusan ? 'Lulus' : 'Tidak Lulus')
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $count = $this->data->count();

                $event->sheet->getStyle('A1:H1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => [
                            'rgb' => 'FFFFFF'
                        ]
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => [
                            'rgb' => '000000'
                        ]
                    ]
                ]);

                $event->sheet->setAutoFilter('A1:H' . $count);
                $event->sheet->getStyle('A1:H' . ($count + 1))->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000']
                        ]
                    ]
                ]);
            }
        ];
    }
}
