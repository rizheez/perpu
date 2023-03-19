<?php

use App\Models\Penulis;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\Auth\LogoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Route untuk mengakses halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// Route untuk mengakses halaman dashboard petugas
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth:petugas');

// Route untuk mengakses halaman buku
Route::controller(BukuController::class)->group(function () {
    Route::get('/admin/buku', 'index')->name('buku.index'); // Halaman daftar buku
    Route::get('/admin/buku/tambahdata', 'create')->name('buku.create'); // Halaman form tambah buku
    Route::get('/admin/buku/{id}/edit', 'edit')->name('buku.update'); // Halaman form edit buku dengan id tertentu
    Route::post('/admin/buku/tambahdata', 'store')->name('buku.store'); // Aksi tambah buku ke database
    Route::put('/admin/buku/{id}', 'update')->name('buku.edit'); // Aksi edit buku dengan id tertentu pada database
    Route::delete('/admin/buku/{id}', 'delete')->name('buku.hapus'); // Aksi hapus buku dengan id tertentu pada database
})->middleware('auth:petugas');

// Route untuk mengakses halaman petugas (hanya admin yang dapat mengakses)
Route::middleware('admin')->group(function () {
    // routes for admin
    Route::controller(PetugasController::class)->group(function () {
        Route::get('/admin/petugas', 'index')->name('petugas.index'); // Halaman daftar petugas
        Route::get('/admin/petugas/tambahdata', 'create')->name('petugas.create'); // Halaman form tambah petugas
        Route::get('/admin/petugas/{id}/edit', 'edit')->name('petugas.update'); // Halaman form edit petugas dengan id tertentu
        Route::post('/admin/petugas/tambahdata', 'store')->name('petugas.store'); // Aksi tambah petugas ke database
        Route::put('/admin/petugas/{id}', 'update')->name('petugas.edit'); // Aksi edit petugas dengan id tertentu pada database
        Route::delete('/admin/petugas/{id}', 'delete')->name('petugas.hapus'); // Aksi hapus petugas dengan id tertentu pada database
    });
});

// Route untuk mengakses halaman profil petugas
Route::controller(PetugasController::class)->group(function () {
    Route::get('/admin/petugas/account/{id}', 'account')->name('petugas.account'); // Halaman profil petugas dengan id tertentu
    Route::put('/admin/petugas/account/{id}', 'editAccount')->name('petugas.edits'); // Aksi edit profil petugas dengan id tertentu pada database
})->middleware('auth:petugas');

// Route untuk mengakses halaman anggota
Route::controller(AnggotaController::class)->group(function () {
    Route::get('/admin/anggota', 'index')->name('anggota.index'); // Menampilkan daftar anggota
    Route::get('/admin/anggota/tambahdata', 'create')->name('anggota.create'); // Menampilkan form untuk menambahkan data anggota baru
    Route::get('/admin/anggota/{id}/edit', 'edit')->name('anggota.update'); // Menampilkan form untuk mengubah data anggota dengan id tertentu
    Route::post('/admin/anggota/tambahdata', 'store')->name('anggota.store'); // Menyimpan data anggota baru ke dalam database
    Route::put('/admin/anggota/{id}', 'update')->name('anggota.edit'); // Mengubah data anggota dengan id tertentu di dalam database
    Route::delete('/admin/anggota/{id}', 'delete')->name('anggota.hapus'); // Menghapus data anggota dengan id tertentu dari database
    Route::get('/admin/anggota/cetak-kartu/{id}', 'generateCard')->name('anggota.cetak'); // Mencetak kartu anggota dengan id tertentu
    Route::post('/admin/anggota/laporan/', 'generatePdf')->name('laporan.anggota'); // Membuat laporan data anggota dalam format PDF
})->middleware('auth:petugas');


// Route untuk mengakses halaman penulis
Route::controller(PenulisController::class)->group(function () {
    Route::get('/admin/penulis', 'index')->name('penulis.index'); // Menampilkan daftar penulis
    Route::get('/admin/penulis/{id}/edit', 'edit')->name('penulis.update'); // Menampilkan form untuk mengubah data penulis dengan id tertentu
    Route::post('/admin/penulis', 'store')->name('penulis.store'); // Menyimpan data penulis baru ke dalam database
    Route::put('/admin/penulis/{id}', 'update')->name('penulis.edit'); // Mengubah data penulis dengan id tertentu di dalam database
    Route::delete('/admin/penulis/{id}', 'delete')->name('penulis.hapus'); // Menghapus data penulis dengan id tertentu dari database
})->middleware('auth:petugas');

// Route untuk mengakses halaman kategori
Route::controller(KategoriController::class)->group(function () {
    Route::get('/admin/kategori', 'index')->name('kategori.index'); // Menampilkan daftar kategori buku
    Route::get('/admin/kategori/{id}/edit', 'edit')->name('kategori.update'); // Menampilkan form untuk mengubah data kategori buku dengan id tertentu
    Route::post('/admin/kategori', 'store')->name('kategori.store'); // Menyimpan data kategori buku baru ke dalam database
    Route::put('/admin/kategori/{id}', 'update')->name('kategori.edit'); // Mengubah data kategori buku dengan id tertentu di dalam database
    Route::delete('/admin/kategori/{id}', 'delete')->name('kategori.hapus'); // Menghapus data kategori buku dengan id tertentu dari database
})->middleware('auth:petugas');

// Route untuk mengelola peminjaman buku
Route::controller(PeminjamanController::class)->group(function () {
    Route::get('/admin/peminjaman', 'index')->name('peminjaman.index'); // Menampilkan halaman index peminjaman
    Route::get('/admin/peminjaman/tambahdata', 'create')->name('peminjaman.create'); // Menampilkan halaman form tambah peminjaman
    Route::get('/admin/peminjaman/{id}/edit', 'edit')->name('peminjaman.update'); // Menampilkan halaman form edit peminjaman
    Route::post('/admin/peminjaman/tambahdata', 'store')->name('peminjaman.store'); // Menambahkan data peminjaman
    Route::put('/admin/peminjaman/{id}', 'update')->name('peminjaman.edit'); // Mengupdate data peminjaman
    Route::delete('/admin/peminjaman/{id}', 'delete')->name('peminjaman.hapus'); // Menghapus data peminjaman
    Route::post('/admin/peminjaman/laporan/', 'generatePdf')->name('laporan.peminjaman'); // Membuat laporan peminjaman dalam bentuk PDF
})->middleware('auth:petugas');


// Menangani authentication, termasuk login dan logout
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
});

Route::controller(LogoutController::class)->group(function () {
    Route::post('/logout', 'logout')->name('logout');
});
