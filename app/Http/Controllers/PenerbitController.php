<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class PenerbitController extends Controller
{
    public function index(Request $request)
    {
        $data = Penerbit::all();
        if ($request->ajax()) {

            $datatable = Datatables::of($data);
            $datatable->addIndexColumn();
            return $datatable->make(true);
        }
        return view('content.informasi.penerbit.penerbit', ['data' => $data]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
        ]);
        Penerbit::create([
            'nama' => $request->nama,

        ]);

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        return response()->json(['result' => $penerbit]);
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'nama' => 'required|string|max:255',
        ]);


        $penerbit = Penerbit::find($id);
        $penerbit->nama = $request->nama;
        $penerbit->save();

        return response()->json(['success' => true, 'message' => 'Success']);
    }

    public function delete($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        $penerbit->delete();

        return response()->json(['success' => true]);
    }
}
