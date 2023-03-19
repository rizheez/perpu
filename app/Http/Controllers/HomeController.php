<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // method untuk menampilkan data
    public function index(Request $request)
    {
        $data = Buku::with(['penulis', 'kategori'])->get();
        // cek apakah request ajax
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addIndexColumn()
                ->make(true);
        }
        // jika bukan request ajax, maka tampilkan view anggota
        return view('content.home.home');
    }
}
