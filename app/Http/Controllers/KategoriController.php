<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $data = Kategori::all();
        if ($request->ajax()) {

            $datatable = Datatables::of($data);
            $datatable->addIndexColumn();

            return $datatable->make(true);
        }
        return view('content.kategori', ['data' => $data]);
    }


    public function showData()
    {
        // $penulis = Penulis::all();
        // return Datatables::of($penulis)->make(true);
        $kategori = Kategori::all();
        return view('content.kategori', ['kategori' => $kategori]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',

        ]);

        Kategori::create([
            'nama' => $request->nama,
        ]);

        return response()->json(['success' => true]);
    }


    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return response()->json(['result' => $kategori]);
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'nama' => 'required|string|max:255',
        ]);


        // $kategori = Kategori::find($id);
        // $kategori->nama = $request->nama;
        // $kategori->save();

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


    public function delete($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return response()->json(['success' => true]);
    }
}
