<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // mengambil data jumlah peminjaman buku perbulan dari database
        $year = date('Y');
        $borrow_counts = DB::table('peminjaman')
            ->select(DB::raw('DATE_FORMAT(tanggal_peminjaman, "%Y-%m") AS month'), DB::raw('COUNT(*) AS count'))
            ->whereYear('tanggal_peminjaman', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // menginisialisasi array data dengan nilai 0
        $data = array_fill(0, 12, 0);

        // mengubah nilai array data untuk bulan-bulan yang memiliki data peminjaman
        foreach ($borrow_counts as $borrow_count) {
            $monthIndex = intval(substr($borrow_count->month, 5)) - 1;
            $data[$monthIndex] = $borrow_count->count;
        }

        // mengambil top 10 buku yang sering dipinjam
        $top_books = DB::table('peminjaman')
                    ->join('buku', 'peminjaman.buku_id', '=', 'buku.id')
                    ->select('buku.judul', DB::raw('COUNT(*) AS count'))
                    ->groupBy('peminjaman.buku_id', 'buku.judul')
                    ->orderByDesc('count')
                    ->limit(5)
                    ->get();

        // Mengambil total buku dari database
        $totalBuku = Buku::count();

        // Mengambil total kategori dari database
        $kategori = Kategori::count();

        // Mengambil total anggota dari database
        $anggota = Anggota::count();

        // Mengambil total peminjaman dari database
        $peminjaman = Peminjaman::count();

        // menghasilkan view dengan data chart
        return view('content.dashboard', [
            'data' => $data,
            'top_books' => $top_books,
            'totalBuku' => $totalBuku,
            'kategori' => $kategori,
            'anggota' => $anggota,
            'peminjaman' => $peminjaman
        ]);

       
    }
}
