<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
  public function loginFlutter(Request $request)
{
    $email = $request->input('email'); // gunakan input()
    $password = $request->input('password'); // gunakan input()

    $pengguna = DB::table('pengguna')->where('email', $email)->first();

    if (!$pengguna) {
        return response()->json(['message' => 'Email tidak ditemukan'], 404);
    }

    if (!Hash::check($password, $pengguna->password)) {
        return response()->json(['message' => 'Password salah'], 401);
    }

    return response()->json([
        'status' => true,
        'message' => 'Login berhasil',
        'data' => [
            'id' => $pengguna->id,
            'nama' => $pengguna->nama,
            'email' => $pengguna->email
        ]
    ], 200);
}



    public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nama' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:pengguna,email',
        'password' => 'required|string|min:6',
        'no_hp' => 'required|string',
        'alamat' => 'required|string',
    ]);

   

        $user = Pengguna::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => $request->password, // ✅ CUKUP INI
        'no_hp' => $request->no_hp,
        'alamat' => $request->alamat,
    ]);


    return response()->json([
        'message' => 'User registered successfully',
        'user' => $user
    ], 201);
}

}
