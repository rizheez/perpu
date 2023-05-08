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

        if (!$request->has('kategori')) {
            $request->session()->forget('kategori_id');
        }

        if ($kategori_id && $kategori_id !== 'semua') {
            $request->session()->put('kategori_id', $kategori_id);
        } elseif ($kategori_id === 'semua') {
            $request->session()->forget('kategori_id');
            return redirect()->route('home.list');
        }

        $data = Buku::with('kategori');

        if ($search) {
            $request->session()->forget('kategori_id');
            $data->where('judul', 'like', '%' . $search . '%');
        } elseif ($request->session()->has('kategori_id')) {
            $data->whereHas('kategori', function ($query) use ($request) {
                $query->where('nama', $request->session()->get('kategori_id'));
            });
        }

        $data = $data->paginate(8)->appends(['search' => $search]);

        $kategori = Kategori::all();
        return view('content.home.buku', compact('data', 'kategori'));
    }
}
