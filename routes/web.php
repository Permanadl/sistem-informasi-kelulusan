<?php

use App\Http\Controllers\CekKelulusanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Pages\DataSiswaController;
use App\Http\Controllers\Pages\JurusanController;
use App\Http\Controllers\Pages\PengaturanController;
use App\Http\Controllers\Pages\TahunAjaranController;
use App\Models\Pengaturan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $tanggal_buka = Pengaturan::firstWhere('key', 'tanggal_dibuka')->value;
    $tanggal_tutup = Pengaturan::firstWhere('key', 'tanggal_ditutup')->value;

    if (date('Y-m-d H:i') >= $tanggal_buka and date('Y-m-d H:i') < $tanggal_tutup) {
        $clock = 'SUDAH DIBUKA';
    } elseif (date('Y-m-d H:i') >= $tanggal_tutup) {
        $clock = 'SUDAH DITUTUP';
    } else {
        $clock = 'AKAN DIBUKA PADA ' . $tanggal_buka;
    }

    return view('home', compact('clock'));
});
Route::post('cek-kelulusan', [CekKelulusanController::class, 'cek'])->name('cek-kelulusan');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/chart', [DashboardController::class, 'chart'])->name('dashboard.chart');

    Route::get('data-siswa/kelulusan/{siswa}', [DataSiswaController::class, 'kelulusan']);
    Route::post('data-siswa/kelulusan/{siswa}', [DataSiswaController::class, 'simpanKelulusan'])->name('data-siswa.kelulusan');
    Route::get('data-siswa/export', [DataSiswaController::class, 'export']);
    Route::post('data-siswa/export', [DataSiswaController::class, 'prosesExport'])->name('data-siswa.export');
    Route::get('data-siswa/import', [DataSiswaController::class, 'import']);
    Route::get('data-siswa/format-excel', [DataSiswaController::class, 'formatExcel']);
    Route::post('data-siswa/import', [DataSiswaController::class, 'prosesImport'])->name('data-siswa.import');
    Route::resource('data-siswa', DataSiswaController::class)->except(['show']);

    Route::resource('jurusan', JurusanController::class);
    Route::resource('tahun-ajaran', TahunAjaranController::class);

    Route::get('pengaturan', [PengaturanController::class, 'index']);
    Route::post('pengaturan/store-general', [PengaturanController::class, 'storeGeneral']);
    Route::post('pengaturan/store-login', [PengaturanController::class, 'storeLogin']);
});
