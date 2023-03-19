<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Petugas;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $data = Peminjaman::with(['buku', 'anggota', 'petugas'])->get();
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('content.peminjaman.button')->with('data', $data);
                })
                ->make(true);
        }

        return view('content.peminjaman.peminjaman');
    }

    // method untuk menampilkan form tambah peminjaman
    public function create()
    {
        $data = Peminjaman::with(['buku', 'anggota'])->get();

        $buku = Buku::pluck('judul', 'id');
        $anggota = Anggota::pluck('nama', 'id');

        return view('content.peminjaman.formTambah', compact('data', 'buku', 'anggota'));
    }

    // method untuk menyimpan data peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required',
            'anggota_id' => 'required',
        ]);

        $peminjaman = new Peminjaman;

        $peminjaman->buku_id = $request->buku_id;

        $buku = Buku::find($peminjaman->buku_id);
        $buku->stok -= 1;

        $peminjaman->anggota_id = $request->anggota_id;
        $peminjaman->tanggal_peminjaman = $request->tanggal_peminjaman;
        $peminjaman->petugas_id = Auth::guard('petugas')->user()->id; // atur nilai petugas_id dari user yang sedang login
        $buku->save();
        $peminjaman->save();



        return redirect()->back()->with('success', 'Peminjaman berhasil ditambahkan');
    }
    // method untuk menampilkan form edit peminjaman
    public function edit($id)
    {
        $data = Peminjaman::find($id);

        return view('content.peminjaman.editPeminjaman', compact('data'));
    }

    // method untuk mengupdate data anggota
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $buku = Buku::find($peminjaman->buku_id);
        $buku->stok += 1;
        $buku->save();

        $peminjaman->tanggal_pengembalian = $request->tanggal_pengembalian;

        // Menghitung selisih hari antara tanggal kembali dan tanggal pinjam
        $tanggal_pengembalian = Carbon::parse($request->tanggal_pengembalian);
        $tanggal_peminjaman = Carbon::parse($peminjaman->tanggal_peminjaman);
        $selisihHari = $tanggal_pengembalian->diffInDays($tanggal_peminjaman);

        // Menghitung denda jika telat mengembalikan buku
        $denda = 0;
        if ($selisihHari > 7) {
            $denda = ($selisihHari - 7) * 2000;
        }

        $peminjaman->denda = $denda;
        $peminjaman->save();

        return redirect()->route('peminjaman.index');
    }

    // Fungsi ini digunakan untuk menghasilkan laporan dalam format PDF berdasarkan bulan dan tahun yang diberikan oleh pengguna.
    public function generatePDF(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $bulanStr = Carbon::createFromFormat('m', $bulan)->isoFormat('MMMM');

        $peminjaman = Peminjaman::whereMonth('tanggal_pengembalian', $bulan)
            ->whereYear('tanggal_pengembalian', $tahun)
            ->get();


        if ($peminjaman->isEmpty()) {
            return redirect()->back()->with('error', "Tidak ada data peminjaman pada bulan {$bulanStr} tahun {$tahun}.");
        }

        $pdf = Pdf::loadView('content.laporan.peminjaman', compact('peminjaman', 'bulan', 'tahun'));

        $pdf->setPaper('A4', 'potrait');
        return $pdf->download('laporan-peminjaman-' . $bulan . '-' . $tahun . '.pdf');
    }
}
