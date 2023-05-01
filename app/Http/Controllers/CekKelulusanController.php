<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class CekKelulusanController extends Controller
{
    public function cek(Request $request)
    {
        try {
            $tanggal_buka = Pengaturan::firstWhere('key', 'tanggal_dibuka')->value;
            $tanggal_tutup = Pengaturan::firstWhere('key', 'tanggal_ditutup')->value;

            if (date('Y-m-d H:i') >= $tanggal_tutup) {
                throw new \Exception('Informasi kelulusan sudah ditutup', 1);
            } else {
                throw new \Exception('Informasi kelulusan belum dibuka', 1);
            }

            if (!$request->nis or !$request->nisn) {
                throw new \Exception('NIS dan NISN harus diisi', 1);
            }

            $siswa = Siswa::where([
                ['nis', $request->nis],
                ['nisn', $request->nisn]
            ])->first();

            if (!$siswa) {
                throw new \Exception('Data siswa tidak ditemukan', 1);
            }

            if ($siswa->status_kelulusan == null) {
                throw new \Exception('Informasi kelulusan belum diupdate, coba lagi nanti', 1);
            }

            if ($siswa->tahunAjaran->aktif == 0) {
                throw new \Exception('Informasi kelulusan tahun ajaran ' . $siswa->tahunAjaran->tahun_ajaran . ' sudah ditutup', 1);
            }

            $siswa->status_lihat = 1;
            $siswa->save();

            $pengumuman = Pengaturan::firstWhere('key', 'pengumuman')->value;

            return view('cek-kelulusan', compact('siswa', 'pengumuman'));
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getCode() ? $th->getMessage() : 'Cek kelulusan gagal, coba lagi nanti'
            ], 401);
        }
    }
}
