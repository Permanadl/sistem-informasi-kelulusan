<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\TahunAjaran;

class DashboardController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::withCount(['siswa' => function ($query) {
            $query->where('status_kelulusan', 1);
        }])->get();

        return view('dashboard', compact('jurusan'));
    }

    public function chart()
    {
        $jumlah_lulusan = TahunAjaran::withCount(['siswa' => function ($query) {
            $query->where('status_kelulusan', 1);
        }])->orderBy('tahun_ajaran', 'desc')->limit(5)->get()->sortBy('tahun_ajaran')->pluck('siswa_count', 'tahun_ajaran');

        $jumlah_dilihat = TahunAjaran::withCount(['siswa' => function ($query) {
            $query->where('status_lihat', 1);
        }])->orderBy('tahun_ajaran', 'desc')->limit(5)->get()->sortBy('tahun_ajaran')->pluck('siswa_count', 'tahun_ajaran');

        return compact('jumlah_lulusan', 'jumlah_dilihat');
    }
}
