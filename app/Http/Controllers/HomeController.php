<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // method untuk menampilkan data
    public function index()
    {
        $data = Buku::with('kategori')->limit(8)->get();

        return view('content.home.home', compact('data'));
    }

    public function listBuku(Request $request)
    {

        $kategori_id = $request->input('kategori');
        $search = $request->input('search');

        if ($kategori_id) {
            if ($kategori_id == 'semua') {
                $request->session()->forget('kategori_id');
                return redirect()->route('home.list');
            } else {
                $request->session()->put('kategori_id', $kategori_id);
            }
        }

        $data = Buku::with('kategori');

        if ($search) {
            $data->where('judul', 'like', '%' . $search . '%');
            if (!$data->count()) {
                return redirect()->route('home.list')->with('message', 'Buku tidak ditemukan');
            }
        } elseif ($request->session()->has('kategori_id')) {
            $kategori_id = $request->session()->get('kategori_id');
            $data->whereHas('kategori', function ($query) use ($kategori_id) {
                $query->where('nama', $kategori_id);
            });
        }

        $data = $data->paginate(8)->appends(['search' => $search]);

        $kategori = Kategori::all();
        return view('content.home.buku', compact(['data', 'kategori']));
    }
}
