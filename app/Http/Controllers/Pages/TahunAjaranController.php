<?php

namespace App\Http\Controllers\Pages;

use App\DataTables\TahunAjaranDataTable;
use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TahunAjaranDataTable $datatable)
    {
        return $datatable->render('pages.tahunajaran');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(TahunAjaran $tahunAjaran)
    {
        return view('pages.tahunajaran-form', compact('tahunAjaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['tahun_ajaran' => 'required|unique:tahun_ajaran,tahun_ajaran']);
        try {
            TahunAjaran::create(['tahun_ajaran' => $request->tahun_ajaran, 'aktif' => $request->aktif ? 1 : 0]);

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TahunAjaran $tahunAjaran)
    {
        $url = route('tahun-ajaran.update', $tahunAjaran->id);
        return view('pages.tahunajaran-form', compact('tahunAjaran', 'url'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TahunAjaran $tahunAjaran)
    {
        $request->validate(['tahun_ajaran' => ['required', Rule::unique('tahun_ajaran', 'tahun_ajaran')->ignore($tahunAjaran)]]);
        try {
            $tahunAjaran->tahun_ajaran = $request->tahun_ajaran;
            $tahunAjaran->aktif = $request->aktif ? 1 : 0;
            $tahunAjaran->save();

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TahunAjaran $tahunAjaran)
    {
        try {
            if ($tahunAjaran->siswa->count()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Sudah ada data siswa di tahun ajaran ini',
                ], 401);
            }

            $tahunAjaran->delete();

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
