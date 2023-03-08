<?php

namespace App\Http\Controllers;

use App\Models\Penulis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PenulisController extends Controller
{
    public function index()
    {
        return view('content.penulis');
    }

    public function showData()
    {
        // $penulis = Penulis::all();
        // return Datatables::of($penulis)->make(true);
        $penulis = Penulis::all();
        return view('content.penulis', ['penulis' => $penulis]);
    }

    // public function kategori()
    // {
    //     $kategori = DB::table('kategori')->get();
    //     return view('kategori', ['kategori' => $kategori]);
    // }

    public function tambahData(Request $request)
    {
        $Penulis = new Penulis;
        $Penulis->nama = $request->input('nama');
        $Penulis->email = $request->input('email');
        $Penulis->save();

        return redirect()->route('penulis.index');
        return response()->json(['success' => 'Data kategori berhasil ditambahkan!', 'id_penulis' => $Penulis->id]);
    }

    public function edit($id)
    {
        $penulis = Penulis::findOrFail($id);

        return view('content.penulis_edit', compact('penulis'));
    }

    public function EditData(Request $request, $id)
    {


        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'max:255',
            'email' => 'max:255',
        ]);

        // Ambil data kategori dari database berdasarkan ID
        $penulis = Penulis::findOrFail($id);

        // Update data penulis
        $penulis->nama = $validatedData['nama'];
        $penulis->email = $validatedData['email'];
        $penulis->save();

        // Redirect ke halaman kategori index dengan pesan sukses
        return redirect()->route('penulis.index')->with('success', 'Penulis berhasil diupdate.');
    }

    public function hapusData($id)
    {


        $penulis = Penulis::findOrFail($id);
        $penulis->delete();

        return redirect()->route('penulis.index')->with('success', 'Penulis has been deleted!');
    }
}
