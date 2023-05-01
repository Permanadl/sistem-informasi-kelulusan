<?php

namespace App\Exports;

use App\Models\Jurusan;
use App\Models\TahunAjaran;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Style\Protection;

class FormatExcelExport implements FromArray, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $total = 10;

    public function array(): array
    {
        $data = [];
        for ($i = 1; $i <= $this->total; $i++) {
            $data[] = ['', '', '', '', '', ''];
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'NIS',
            'NISN',
            'NAMA SISWA',
            'JENIS KELAMIN',
            'TAHUN AJARAN',
            'JURUSAN'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:F1')->applyFromArray([
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

                $list = "Laki-Laki,Perempuan";
                $validation = $event->sheet->getCell('D2')->getDataValidation();
                $validation->setType(DataValidation::TYPE_LIST);
                $validation->setAllowBlank(true);
                $validation->setShowDropdown(true);
                $validation->setFormula1('"' . $list . '"');

                for ($i = 3; $i <= $this->total; $i++) {
                    $event->sheet->getCell("D$i")->setDataValidation(clone $validation);
                }

                $tahun_ajaran = TahunAjaran::where('aktif', 1)->get()->implode('tahun_ajaran', ',');
                $validation = $event->sheet->getCell('E2')->getDataValidation();
                $validation->setType(DataValidation::TYPE_LIST);
                $validation->setAllowBlank(true);
                $validation->setShowDropdown(true);
                $validation->setFormula1('"' . $tahun_ajaran . '"');

                for ($i = 3; $i <= $this->total; $i++) {
                    $event->sheet->getCell("E$i")->setDataValidation(clone $validation);
                }

                $jurusan = Jurusan::all()->implode('nama_jurusan', ',');
                $validation = $event->sheet->getCell('F2')->getDataValidation();
                $validation->setType(DataValidation::TYPE_LIST);
                $validation->setAllowBlank(true);
                $validation->setShowDropdown(true);
                $validation->setFormula1('"' . $jurusan . '"');

                for ($i = 3; $i <= $this->total; $i++) {
                    $event->sheet->getCell("F$i")->setDataValidation(clone $validation);
                }
            }
        ];
    }
}
