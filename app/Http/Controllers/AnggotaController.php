<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;


use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Intervention\Image\Gd\Font;
use Intervention\Image\Facades\Image;
use Milon\Barcode\Facades\DNS1DFacade;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    // method untuk menampilkan data anggota
    public function index(Request $request)
    {
        $data = Anggota::all();
        // cek apakah request ajax
        if ($request->ajax()) {
            // menggunakan datatables untuk membuat tabel yang bisa diurutkan
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    // memanggil view button untuk tombol edit dan delete
                    return view('content.anggota.button')->with('data', $data);
                })
                ->make(true);
        }

        // jika bukan request ajax, maka tampilkan view anggota
        return view('content.anggota.anggota');
    }

    // method untuk menampilkan form tambah anggota
    public function create()
    {
        $anggota = Anggota::all();

        return view('content.anggota.formTambah', compact('anggota'));
    }

    // method untuk menyimpan data anggota
    public function store(Request $request)
    {
        //validasi data yang telah dimasukkan
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'email' => 'required|email|max:255',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // membuat instance anggota dan mengisi datanya dari input user
        $anggota = new Anggota;
        $anggota->nama = $request->nama;
        $anggota->alamat = $request->alamat;
        $anggota->telepon = $request->telepon;
        $anggota->email = $request->email;

        // menyimpan file gambar ke storage jika user mengupload gambar
        if ($request->hasFile('profile')) {
            $gambar = $request->file('profile');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->storeAs('public/anggota/profile', $namaGambar);
            $anggota->profile = $namaGambar;
        }

        // menyimpan data anggota ke database
        $anggota->save();

        // redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan');
    }

    // method untuk menampilkan form edit anggota
    public function edit($id)
    {
        $data = Anggota::find($id);

        return view('content.anggota.editAnggota', compact('data'));
    }

    // method untuk mengupdate data anggota
    public function update(Request $request, $id)
    {
        //validasi data yang telah dimasukkan
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'email' => 'required|email|max:255',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);


        // mencari anggota yang akan diupdate
        $anggota = Anggota::find($id);
        // mengisi data anggota dengan input user
        $anggota->nama = $request->nama;
        $anggota->alamat = $request->alamat;
        $anggota->telepon = $request->telepon;
        $anggota->email = $request->email;
        if ($request->hasFile('profile')) {
            // Hapus gambar lama
            Storage::delete('public/anggota/profile' . $anggota->profile);

            $gambar = $request->file('profile');
            $namaGambar = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->storeAs('public/anggota/profile', $namaGambar);
            $anggota->profile = $namaGambar;
        }
        // menyimpan data anggota ke database
        $anggota->save();
        // redirect ke halaman anggota dengan pesan sukses
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil di Edit');
    }

    // Fungsi untuk menghapus data anggota
    public function delete($id)
    {
        $anggota = Anggota::findOrFail($id);

        if (!$anggota) {
            return response()->json(['message' => 'Anggota tidak ditemukan'], 404);
        }

        if ($anggota->exists()) {
            // menghapus file gambar di storage jika ada
            if ($anggota->profile != null) {
                Storage::delete('public/anggota/profile' . $anggota->gambar);
            }
            $anggota->delete();
            return response()->json(['message' => 'Anggota berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Anggota tidak ditemukan'], 404);
        }
    }

    // Fungsi untuk membuat kartu anggota dalam format gambar png
    public function generateCard($id)
    {
        $anggota = Anggota::find($id);

        // memuat gambar template kartu
        $template = Image::make(public_path('assets/img/kartu2.png'));

        // menambahkan id anggota ke kartu
        $template->text($anggota->id, 220, 252, function ($font) {
            $font->file(public_path('font/Nunito-SemiBold.ttf'));
            $font->size(25);
            $font->color('#000000');
        });
        // menambahkan nama anggota ke kartu
        $template->text($anggota->nama, 220, 339, function ($font) {
            $font->file(public_path('font/Nunito-SemiBold.ttf'));
            $font->size(25);
            $font->color('#000000');
        });

        $text = wordWrap($anggota->alamat, 30);
        // menambahkan alamat anggota ke kartu
        $template->text($text, 220, 379, function ($font) {
            $font->file(public_path('font/Nunito-SemiBold.ttf'));
            $font->size(25);
            $font->color('#000000');
            $font->align('left');
            $font->valign('left');
        });

        // menambahkan email anggota ke kartu
        $template->text($anggota->email, 220, 465, function ($font) {
            $font->file(public_path('font/Nunito-SemiBold.ttf'));
            $font->size(25);
            $font->color('#000000');
        });

        // menambahkan no hp anggota ke kartu
        $template->text($anggota->telepon, 220, 507, function ($font) {
            $font->file(public_path('font/Nunito-SemiBold.ttf'));
            $font->size(25);
            $font->color('#000000');
        });

        // menambahkan barcode anggota ke kartu
        $barcode = DNS1DFacade::getBarcodePNG($anggota->id, 'C39', 2, 70, array(0, 0, 0), true);
        $barcodeImage = Image::make($barcode);
        $barcodeImage->resize($barcodeImage->getWidth() * 1.05, $barcodeImage->getHeight() * 1.05);
        $template->insert($barcodeImage, 'bottom-left', 130, 10);


        // menambahkan foto anggota ke kartu
        $profileImage = Image::make(public_path('storage/anggota/profile/' . $anggota->profile));
        $profileImage->fit(310, 350);
        $template->insert($profileImage, 'bottom-right', 40, 125);

        // menyimpan kartu anggota
        $template->save(public_path('cards/' . $anggota->id . '.png'));

        // mengembalikan respons beserta mendownload file kartu anggota
        return response()->download(public_path('cards/' . $anggota->id . '.png'));
    }

    // Fungsi ini digunakan untuk menghasilkan laporan dalam format PDF berdasarkan bulan dan tahun yang diberikan oleh pengguna.
    public function generatePDF(Request $request)
    {
        // Mengambil data anggota yang dibuat pada bulan dan tahun yang diberikan oleh pengguna
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $anggota = Anggota::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();

        // Mengonversi bulan numerik menjadi string
        $bulanStr = Carbon::createFromFormat('m', $bulan)->isoFormat('MMMM');

        // Memeriksa apakah data anggota kosong dan mengembalikan pesan kesalahan yang sesuai jika kosong
        if ($anggota->isEmpty()) {
            return redirect()->back()->with('error', "Tidak ada data anggota pada bulan {$bulanStr} tahun {$tahun}.");
        }
        // Jika data anggota tersedia, fungsi ini akan memuat tampilan laporan anggota dan mengembalikan file PDF untuk diunduh
        $pdf = Pdf::loadView('content.laporan.anggota', compact('anggota', 'bulan', 'tahun'));
        // Ukuran kertas PDF diatur ke A4 dengan orientasi landscape.
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('laporan-anggota-' . $bulan . '-' . $tahun . '.pdf');
    }
}
