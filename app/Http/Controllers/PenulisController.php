<?php

namespace App\Http\Controllers;

use App\Models\Penulis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class PenulisController extends Controller
{
    public function index(Request $request)
    {
        $data = Penulis::all();
        if ($request->ajax()) {

            $datatable = Datatables::of($data);
            $datatable->addIndexColumn();
            // $datatable->addColumn('Aksi', function ($row) {
            //     $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
            //     $btn .= '&nbsp;&nbsp;';
            //     $btn .= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
            //     return $btn;
            // });
            return $datatable->make(true);
        }
        return view('content.informasi.penulis.penulis', ['data' => $data]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);

        Penulis::create([
            'nama' => $request->nama,
            'email' => $request->email,

        ]);

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $penulis = Penulis::findOrFail($id);
        return response()->json(['result' => $penulis]);
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'
        ]);


        $penulis = Penulis::find($id);
        $penulis->nama = $request->nama;
        $penulis->email = $request->email;
        $penulis->save();

        return response()->json(['success' => true, 'message' => 'Success']);
    }

    public function delete($id)
    {
        $user = Penulis::findOrFail($id);
        $user->delete();

        return response()->json(['success' => true]);
    }
}
