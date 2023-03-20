<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penulis;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    // method untuk menampilkan data buku
    public function index(Request $request)
    {
        $data = Buku::with(['penerbit', 'kategori'])->get();
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('content.informasi.buku.button')->with('data', $data);
                })
                ->make(true);
        }
        // jika bukan request ajax, maka tampilkan view buku
        return view('content.informasi.buku.buku');
    }

    // method untuk menampilkan form tambah anggota
    public function create()
    {
        $penerbit = Penerbit::all();
        $kategori = Kategori::all();

        return view('content.informasi.buku.formTambahBuku', compact('penerbit', 'kategori'));
    }

    // method untuk menyimpan data anggota
    public function store(Request $request)
    {
        //validasi data yang telah dimasukkan
        $request->validate([
            'judul' => 'required|string|max:100',
            'penulis' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'penerbit_id' => 'required|exists:penerbit,id',
            'tahun_terbit' => 'required|string|max:4',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // membuat instance anggota dan mengisi datanya dari input user
        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->kategori_id = $request->kategori_id;
        $buku->penerbit_id = $request->penerbit_id;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->stok = $request->stok;

        // menyimpan file gambar ke storage jika user mengupload gambar
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->storeAs('public/buku/gambar', $namaGambar);
            $buku->gambar = $namaGambar;
        }

        // menyimpan data anggota ke database
        $buku->save();

        // redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Buku berhasil ditambahkan');
    }

    // method untuk menampilkan form edit anggota
    public function edit($id)
    {
        $data = Buku::find($id);
        $penerbit = Penerbit::all();
        $kategori = Kategori::all();
        return view('content.informasi.buku.editBuku', compact('data', 'penerbit', 'kategori'));
    }

    // method untuk mengupdate data anggota
    public function update(Request $request, $id)
    {

        //validasi data yang telah dimasukkan
        $request->validate([
            'judul' => 'required|string|max:100',
            'penulis' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'penerbit_id' => 'required|string|max:255|exists:penerbit,id',
            'tahun_terbit' => 'required|string|max:4',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:4048'
        ]);

        // mencari anggota yang akan diupdate
        $buku = Buku::find($id);
        // mengisi data anggota dengan input user
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->kategori_id = $request->kategori_id;
        $buku->penerbit_id = $request->penerbit_id;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->stok = $request->stok;
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            Storage::delete('public/buku/gambar' . $buku->gambar);

            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->storeAs('public/buku/gambar', $namaGambar);
            $buku->gambar = $namaGambar;
        }
        // menyimpan data anggota ke database
        $buku->save();
        // redirect ke halaman anggota dengan pesan sukses
        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan');
    }

    // Fungsi untuk menghapus data anggota
    public function delete($id)
    {
        $buku = Buku::findOrFail($id);
        //hapus file gambar di stograge
        if ($buku->gambar != null) {
            Storage::delete('public/buku/gambar' . $buku->gambar);
        }
        $buku->delete();

        return response()->json(['success' => true]);
    }
}
