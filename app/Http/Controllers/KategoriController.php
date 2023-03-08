<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index()
    {
        return view('content.kategori');
    }

    public function showData()
    {
        // $penulis = Penulis::all();
        // return Datatables::of($penulis)->make(true);
        $kategori = Kategori::all();
        return view('content.kategori', ['kategori' => $kategori]);
    }

    // public function kategori()
    // {
    //     $kategori = DB::table('kategori')->get();
    //     return view('kategori', ['kategori' => $kategori]);
    // }

    public function tambahData(Request $request)
    {
        $Kategori = new Kategori;
        $Kategori->nama = $request->input('nama');
        $Kategori->save();

        return redirect()->route('kategori.index');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('content.kategori_edit', compact('kategori'));
    }

    public function EditData(Request $request, $id)
    {


        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'max:255',
        ]);

        // Ambil data kategori dari database berdasarkan ID
        $Kategori = Kategori::findOrFail($id);

        // Update data Kategori
        $Kategori->nama = $validatedData['nama'];

        $Kategori->save();

        // Redirect ke halaman kategori index dengan pesan sukses
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diupdate.');
    }

    public function hapusData($id)
    {


        $Kategori = Kategori::findOrFail($id);
        $Kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori has been deleted!');
    }
}
