<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penulis;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $data = Buku::with(['penulis', 'kategori'])->get();
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('content.informasi.buku.button')->with('data', $data);
                })
                ->make(true);
        }

        return view('content.informasi.buku.buku');
    }

    public function create()
    {
        $penulis = Penulis::all();
        $kategori = Kategori::all();

        return view('content.informasi.buku.formTambahBuku', compact('penulis', 'kategori'));
    }

    public function detail($id)
    {
        $data = Buku::with(['penulis', 'kategori'])->find($id);
        return view('content.informasi.buku.detail', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:100',
            'penulis_id' => 'required|exists:penulis,id',
            'kategori_id' => 'required|exists:kategori,id',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|string|max:4',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->penulis_id = $request->penulis_id;
        $buku->kategori_id = $request->kategori_id;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->stok = $request->stok;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->storeAs('public', $namaGambar);
            $buku->gambar = $namaGambar;
        }

        $buku->save();

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Buku::find($id);
        $penulis = Penulis::all();
        $kategori = Kategori::all();
        return view('content.informasi.buku.editBuku', compact('data', 'penulis', 'kategori'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'judul' => 'required|string|max:100',
            'penulis_id' => 'required|exists:penulis,id',
            'kategori_id' => 'required|exists:kategori,id',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|string|max:4',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:4048'
        ]);

        $buku = Buku::find($id);
        $buku->judul = $request->judul;
        $buku->penulis_id = $request->penulis_id;
        $buku->kategori_id = $request->kategori_id;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->stok = $request->stok;
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            Storage::delete('public/' . $buku->gambar);

            $gambar = $request->file('gambar');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->storeAs('public', $namaGambar);
            $buku->gambar = $namaGambar;
        }
        $buku->save();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function delete($id)
    {
        $buku = Buku::findOrFail($id);
        //hapus file gambar di stograge
        if ($buku->gambar != null) {
            Storage::delete('public/' . $buku->gambar);
        }
        $buku->delete();

        return response()->json(['success' => true]);
    }
}
