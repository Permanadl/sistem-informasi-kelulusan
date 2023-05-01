<?php

namespace App\Http\Controllers\Pages;

use App\DataTables\JurusanDataTable;
use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JurusanController extends Controller
{
    public function index(JurusanDataTable $datatable)
    {
        return $datatable->render('pages.jurusan');
    }

    public function create(Jurusan $jurusan)
    {
        return view('pages.jurusan-form', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama_jurusan' => 'required|unique:jurusan,nama_jurusan']);
        try {
            Jurusan::create(['nama_jurusan' => $request->nama_jurusan]);

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

    public function edit(Jurusan $jurusan)
    {
        $url = route('jurusan.update', $jurusan->id);
        return view('pages.jurusan-form', compact('jurusan', 'url'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate(['nama_jurusan' => ['required', Rule::unique('jurusan', 'nama_jurusan')->ignore($jurusan)]]);
        try {
            $jurusan->nama_jurusan = $request->nama_jurusan;
            $jurusan->save();

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

    public function destroy(Jurusan $jurusan)
    {
        try {
            if ($jurusan->siswa->count()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Sudah ada data siswa di jurusan ini',
                ], 401);
            }

            $jurusan->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal dihapus',
            ], 401);
        }
    }
}
