<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SuaramuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [PenggunaController::class, 'loginFlutter']);
Route::post('/register', [PenggunaController::class, 'register']);
Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/events', [EventController::class, 'index']);
Route::post('/pengaduan', [PengaduanController::class, 'store']);
Route::get('/pengaduan/{pengguna_id}', [PengaduanController::class, 'riwayat']);
Route::put('/pengaduan/{id}/status', [PengaduanController::class, 'updateStatus']);
Route::post('/suaramu', [SuaramuController::class, 'store']);

