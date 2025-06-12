<?php

namespace App\Http\Controllers;

use App\Models\pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'lokasi' => 'required|string|max:255',
            'jenis_pengaduan' => 'required|in:darurat,biasa',
            'pengguna_id' => 'required|exists:pengguna,id',
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengaduan', 'public');
        }

        $pengaduan = pengaduan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
            'lokasi' => $request->lokasi,
            'jenis_pengaduan' => $request->jenis_pengaduan,
            'status' => 'dikirim',
            'pengguna_id' => $request->pengguna_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengaduan berhasil dikirim',
            'data' => $pengaduan,
        ]);
    }

 public function riwayat($pengguna_id)
    {
        $data = Pengaduan::where('pengguna_id', $pengguna_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Riwayat pengaduan ditemukan',
            'data' => $data
        ]);
    }

    // Update status pengaduan (misal jadi 'diproses', 'selesai', dll)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $pengaduan = Pengaduan::find($id);

        if (!$pengaduan) {
            return response()->json([
                'success' => false,
                'message' => 'Pengaduan tidak ditemukan',
            ], 404);
        }

        $pengaduan->status = $request->status;
        $pengaduan->save();

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui',
            'data' => $pengaduan
        ]);
    }

    
}
