<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use App\Models\User;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = Pengaturan::all()->pluck('value', 'key');
        return view('pages.pengaturan', compact('pengaturan'));
    }

    public function storeGeneral(Request $request)
    {
        $request->validate([
            'banner' => 'nullable|mimes:jpg',
            'tanggal_dibuka' => 'required|date_format:Y-m-d H:i',
            'tanggal_ditutup' => 'required|date_format:Y-m-d H:i'
        ]);

        try {
            $pengaturan = Pengaturan::all();

            if ($request->hasFile('banner')) {
                $file = $request->file('banner');
                $filename = "banner.jpg";
                $file->storeAs('public/asset', $filename);

                $banner = $pengaturan->firstWhere('key', 'banner');
                $banner->value = $filename;
                $banner->save();
            }

            $pengumuman = $pengaturan->firstWhere('key', 'pengumuman');
            $pengumuman->value = $request->pengumuman;
            $pengumuman->save();

            $tanggal_dibuka = $pengaturan->firstWhere('key', 'tanggal_dibuka');
            $tanggal_dibuka->value = $request->tanggal_dibuka;
            $tanggal_dibuka->save();

            $tanggal_ditutup = $pengaturan->firstWhere('key', 'tanggal_ditutup');
            $tanggal_ditutup->value = $request->tanggal_ditutup;
            $tanggal_ditutup->save();

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

    public function storeLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'konfirmasi_password' => 'required|same:password'
        ]);
        try {
            $user = User::find(1);
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->save();

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
}
