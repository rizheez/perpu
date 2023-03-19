<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    // Metode logout untuk menghapus sesi pengguna
    public function logout(Request $request)
    {
        // Jika pengguna sudah masuk, logout pengguna
        if (Auth::guard('petugas')->check()) {
            Auth::guard('petugas')->logout();
        }

        // Invalidasi sesi saat ini
        $request->session()->invalidate();

        // Regenerasi token sesi
        $request->session()->regenerateToken();

        // Arahkan pengguna ke halaman beranda
        return redirect('/');
    }
}
