<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    // method untuk menampilkan data Kategori
    public function index(Request $request)
    {
        $data = Kategori::all();
        // cek apakah request ajax
        if ($request->ajax()) {

            $datatable = Datatables::of($data);
            $datatable->addIndexColumn();

            return $datatable->make(true);
        }
        // jika bukan request ajax, maka tampilkan view anggota
        return view('content.informasi.kategori.kategori', ['data' => $data]);
    }


    public function showData()
    {
        $kategori = Kategori::all();
        return view('content.informasi.kategori.kategori', ['kategori' => $kategori]);
    }

    // method untuk menyimpan data kategori
    public function store(Request $request)
    {
        //validasi data yang telah dimasukkan
        $request->validate([
            'nama' => 'required|max:255',

        ]);

        Kategori::create([
            'nama' => $request->nama,
        ]);

        return response()->json(['success' => true]);
    }

    // method untuk menampilkan form edit kategori
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return response()->json(['result' => $kategori]);
    }

    // method untuk mengupdate data kategori
    public function update(Request $request, $id)
    {

        $request->validate([
            'nama' => 'required|string|max:255',
        ]);


        $kategori = Kategori::find($id);
        $nama_asli = $kategori->nama; // Ambil nilai asli dari database
        $nama_baru = $request->nama; // Ambil nilai baru dari form

        // Bandingkan nilai asli dengan nilai baru
        if ($nama_asli !== $nama_baru) {
            $kategori->nama = $nama_baru;
            $kategori->save();
        }

        return response()->json(['success' => true, 'message' => 'Success']);
    }

    // method untuk menghapus data kategori
    public function delete($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return response()->json(['success' => true]);
    }
}
