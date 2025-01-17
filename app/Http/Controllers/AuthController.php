<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Login.index', [
            "judul" => "Login"
        ]);

    }

    public function aunthenticate(Request $request)
    {
        $credentials = $request->validate([
            'identity' => ['required'],
            'password' => ['required'],
        ]);

        // Menentukan bidang untuk autentikasi berdasarkan apakah 'identity' adalah alamat email atau nama pengguna
        $field = filter_var($credentials['identity'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $validatedData = [
            $field => $credentials['identity'],
            'password' => $credentials['password'],
        ];

        // Melakukan upaya autentikasi pengguna
        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate();

            // Periksa role pengguna
            $user = Auth::user();
            if ($user->jobdesks->role === 'Penanggung Jawab') {
                // Arahkan ke halaman pengembalian-dana jika role adalah Penanggung Jawab
                return redirect()->intended('/pengembalian-dana');
            }

            // Arahkan ke halaman default jika role bukan Penanggung Jawab
            return redirect()->intended('/');
        } else {
            // Autentikasi gagal, kembalikan pengguna ke halaman sebelumnya dengan pesan kesalahan
            return back()->with(['LoginError' => 'Login Gagal']);
        }
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/login');
    }
}