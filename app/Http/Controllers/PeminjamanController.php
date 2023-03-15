<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Petugas;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::all();

        return view('pinjam.index', compact('data'));
    }

    public function create()
    {
        $buku = Buku::pluck('id');
        $anggota = Anggota::pluck('id');
        $petugas = Petugas::pluck('id');

        return view('pinjam.create', compact('buku', 'anggota', 'petugas'));
    }

    public function update()
    {
    }
}
