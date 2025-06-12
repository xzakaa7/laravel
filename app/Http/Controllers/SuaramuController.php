<?php

namespace App\Http\Controllers;

use App\Models\Suaramu;
use Illuminate\Http\Request;

class SuaramuController extends Controller
{
     public function store(Request $request)
    {
        $request->validate([
            'pengguna_id' => 'required|exists:pengguna,id',
            'judul' => 'required|string|max:255',
            'isi_saran' => 'required|string',
            'kategori' => 'required|in:pendidikan,lingkungan,kesehatan,transportasi,lainnya',
        ]);

        $saran = Suaramu::create([
            'pengguna_id' => $request->pengguna_id,
            'judul' => $request->judul,
            'isi_saran' => $request->isi_saran,
            'kategori' => strtolower($request->kategori),
        ]);

        return response()->json([
            'message' => 'Saran berhasil dikirim',
            'data' => $saran,
        ], 200);
    }
}
