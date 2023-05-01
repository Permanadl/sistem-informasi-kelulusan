<?php

namespace App\Imports;

use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Throwable;

class SiswaImport implements ToCollection, WithStartRow, SkipsOnError
{

    public function startRow(): int
    {
        return 2;
    }

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        $data = [];
        $tahun_ajaran = TahunAjaran::pluck('id', 'tahun_ajaran');
        $jurusan = Jurusan::pluck('id', 'nama_jurusan');

        foreach ($rows as $row) {
            if ($row[0]) {
                $data[] = [
                    'nis' => $row[0],
                    'nisn' => $row[1],
                    'nama_siswa' => strtoupper($row[2]),
                    'jenis_kelamin' => $row[3],
                    'tahun_ajaran_id' => $tahun_ajaran[$row[4]] ?? $tahun_ajaran->last(),
                    'jurusan_id' => $jurusan[$row[4]] ?? $jurusan->last()
                ];
            }
        }

        Siswa::insertOrIgnore($data);
    }

    public function onError(Throwable $e)
    {
        return $e;
    }
}
