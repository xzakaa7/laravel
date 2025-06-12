<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
{
    $today = Carbon::today();

    $events = Event::whereDate('waktu', '>=', $today)
        ->orderBy('waktu', 'asc')
        ->get()
        ->map(function ($event) {
            return [
                'id' => $event->id,
                'judul' => $event->judul,
                'deskripsi' => $event->deskripsi,
                'lokasi' => $event->lokasi,
                'waktu' => $event->waktu,
                'gambar' => asset('storage/' . $event->gambar),
            ];
        });

    return response()->json([
        'success' => true,
        'data' => $events,
    ]);
}
}
