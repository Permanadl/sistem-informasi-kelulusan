<?php

namespace App\Http\Controllers\Pages;

use App\DataTables\SiswaDataTable;
use App\Exports\FormatExcelExport;
use App\Exports\SiswaExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiswaRequest;
use App\Imports\SiswaImport;
use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DataSiswaController extends Controller
{
    public function index(SiswaDataTable $datatable)
    {
        return $datatable->render('pages.siswa');
    }

    public function create(Siswa $siswa)
    {
        $tahun_ajaran = TahunAjaran::all();
        $jurusan = Jurusan::all();

        return view('pages.siswa-form', compact('tahun_ajaran', 'jurusan', 'siswa'));
    }

    public function store(SiswaRequest $request)
    {
        try {
            Siswa::create([
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'nama_siswa' => $request->nama_siswa,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tahun_ajaran_id' => $request->tahun_ajaran,
                'jurusan_id' => $request->jurusan,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal disimpan',
            ], 401);
        }
    }

    public function kelulusan(Siswa $siswa)
    {
        return view('pages.siswa-kelulusan', compact('siswa'));
    }

    public function simpanKelulusan(Request $request, Siswa $siswa)
    {
        $request->validate(['status_kelulusan' => 'required', 'surat_kelulusan' => 'required|mimes:pdf']);
        try {
            $file = $request->file('surat_kelulusan');
            $filename = "Surat Kelulusan " . $siswa->nama_siswa . " (" . $siswa->nisn . ").pdf";
            $file->storeAs('public/skl', $filename);

            $siswa->status_kelulusan = $request->status_kelulusan;
            $siswa->surat_kelulusan = $filename;
            $siswa->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal disimpan',
            ], 401);
        }
    }

    public function edit(Siswa $dataSiswa)
    {
        $tahun_ajaran = TahunAjaran::all();
        $jurusan = Jurusan::all();
        $siswa = $dataSiswa;
        $url = route('data-siswa.update', $siswa->id);

        return view('pages.siswa-form', compact('tahun_ajaran', 'jurusan', 'siswa', 'url'));
    }

    public function update(SiswaRequest $request, Siswa $dataSiswa)
    {
        try {
            $dataSiswa->nis = $request->nis;
            $dataSiswa->nisn = $request->nisn;
            $dataSiswa->nama_siswa = $request->nama_siswa;
            $dataSiswa->jenis_kelamin = $request->jenis_kelamin;
            $dataSiswa->tahun_ajaran_id = $request->tahun_ajaran;
            $dataSiswa->jurusan_id = $request->jurusan;
            $dataSiswa->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diubah',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal diubah',
            ], 401);
        }
    }

    public function export()
    {
        $tahun_ajaran = TahunAjaran::all();
        $jurusan = Jurusan::all();

        return view('pages.siswa-export', compact('tahun_ajaran', 'jurusan'));
    }

    public function prosesExport(Request $request)
    {
        $request->validate(['tahun_ajaran' => 'required', 'jurusan' => 'required']);
        try {
            return Excel::download(new SiswaExport($request), 'Data Siswa.xlsx');
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Export gagal',
            ], 401);
        }
    }

    public function import()
    {
        return view('pages.siswa-import');
    }

    public function prosesImport(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx']);
        try {
            Excel::import(new SiswaImport, $request->file('file'));

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Import gagal',
            ], 401);
        }
    }

    public function formatExcel()
    {
        return Excel::download(new FormatExcelExport, 'Format Import Data Siswa.xlsx');
    }
}
