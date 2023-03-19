<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PetugasController extends Controller
{
    public function index(Request $request)
    {

        $data = Petugas::all();
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('content.petugas.button')->with('data', $data);
                })
                ->make(true);
        }

        return view('content.petugas.petugas');
    }

    public function create()
    {
        $petugas = Petugas::all();

        return view('content.petugas.formTambah', compact('petugas'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'email' => 'required|email|max:255',
            'username' => 'required|string|max:50|unique:petugas,username',
            'password' => 'required|max:100',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $petugas = new Petugas;
        $petugas->nama = $request->nama;
        $petugas->alamat = $request->alamat;
        $petugas->telepon = $request->telepon;
        $petugas->email = $request->email;
        $petugas->username = $request->username;
        $petugas->password = bcrypt($request->password);


        if ($request->hasFile('profile')) {
            $gambar = $request->file('profile');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->storeAs('public/petugas/profile', $namaGambar);
            $petugas->profile = $namaGambar;
        }

        $petugas->save();

        return redirect()->back()->with('success', 'Petugas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Petugas::find($id);

        return view('content.petugas.editPetugas', compact('data'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'email' => 'required|email|max:255',
            'username' => 'required|string|max:50',
            'password' => 'required|max:100',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);



        $petugas = Petugas::find($id);
        $petugas->nama = $request->nama;
        $petugas->alamat = $request->alamat;
        $petugas->telepon = $request->telepon;
        $petugas->email = $request->email;
        $petugas->username = $request->username;
        $petugas->password = bcrypt($request->password);
        if ($request->hasFile('profile')) {
            // Hapus gambar lama
            Storage::delete('public/petugas/profile' . $petugas->profile);

            $gambar = $request->file('profile');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->storeAs('public/petugas/profile', $namaGambar);
            $petugas->profile = $namaGambar;
        }
        $petugas->save();

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan');
    }

    public function delete($id)
    {
        $petugas = Petugas::findOrFail($id);
        //hapus file gambar di stograge
        if ($petugas->profile != null) {
            Storage::delete('public/petugas/profile' . $petugas->gambar);
        }
        $petugas->delete();

        return response()->json(['success' => true]);
    }

    public function account($id)
    {
        $data = Petugas::find($id);

        return view('content.petugas.setting', compact('data'));
    }

    public function editAccount(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:50',
            'password' => 'nullable|max:100',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $petugas = Petugas::find($id);

        $petugas->username = $request->username;
        if ($request->password != null) {
            $petugas->password = bcrypt($request->password);
        }
        if ($request->hasFile('profile')) {
            // Hapus gambar lama
            Storage::delete('public/petugas/profile' . $petugas->profile);

            $gambar = $request->file('profile');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->storeAs('public/petugas/profile', $namaGambar);
            $petugas->profile = $namaGambar;
        }
        $petugas->save();

        return redirect()->back()->with('success', 'Akun berhasil diedit');
    }
}
