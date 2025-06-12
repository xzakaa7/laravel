<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\news;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
     public function index()
    {
        $berita = news::where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'judul' => $item->judul,
                    'penulis' => $item->penulis,
                    'isi' => $item->isi,
                    'deskripsi_singkat' => $this->potongIsi($item->isi),
                    'image_url' => asset('storage/' . $item->image),
                    'created_at' => $item->created_at->toDateTimeString(),
                ];
            });

        return response()->json($berita);
    }

    private function potongIsi($text)
    {
        // Ambil maksimal 2 kalimat pertama
        $sentences = preg_split('/(?<=[.!?])\s+/', $text, 3);
        return implode(' ', array_slice($sentences, 0, 2));
    }
}
