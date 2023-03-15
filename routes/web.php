<?php

use App\Models\Penulis;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
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

// Route::get('/dashboard', function () {
//     return view('content.dashboard');
// });

// Route::middleware('auth:petugas,petugas_middleware')->group(function () {
//     // route yang membutuhkan autentikasi
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth:petugas');



// Route::get('/data/stok', [BarangController::class, 'barang'])->name('stok')->middleware('auth:petugas');

Route::controller(BukuController::class)->group(function () {
    Route::get('/buku', 'index')->name('buku.index')->middleware('auth:petugas');
    Route::get('/buku/tambahdata', 'create')->name('buku.create')->middleware('auth:petugas');
    Route::get('/buku/detail/{id}', 'detail')->name('buku.detail')->middleware('auth:petugas');
    Route::get('/buku/{id}/edit', 'edit')->name('buku.update')->middleware('auth:petugas');
    Route::post('/buku/tambahdata', 'store')->name('buku.store')->middleware('auth:petugas');
    Route::put('/buku/{id}', 'update')->name('buku.edit')->middleware('auth:petugas');
    Route::delete('/buku/{id}', 'delete')->name('buku.hapus')->middleware('auth:petugas');
});


Route::controller(PetugasController::class)->group(function () {
    Route::get('/petugas', 'index')->name('petugas.index')->middleware('auth:petugas');
    Route::get('/petugas/tambahdata', 'create')->name('petugas.create')->middleware('auth:petugas');
    Route::get('/petugas/detail/{id}', 'detail')->name('petugas.detail')->middleware('auth:petugas');
    Route::get('/petugas/{id}/edit', 'edit')->name('petugas.update')->middleware('auth:petugas');
    Route::post('/petugas/tambahdata', 'store')->name('petugas.store')->middleware('auth:petugas');
    Route::put('/petugas/{id}', 'update')->name('petugas.edit')->middleware('auth:petugas');
    Route::delete('/petugas/{id}', 'delete')->name('petugas.hapus')->middleware('auth:petugas');
});


//Route Penulis
// Route::get('/penulis', [PenulisController::class, 'showData'])->name('penulis.index')->middleware('auth');
// Route::get('/penulis/edit/{id}', [PenulisController::class, 'edit'])->name('penulis.update')->middleware('auth');
// Route::post('/penulis', [PenulisController::class, 'tambahData'])->name('penulis.tambah')->middleware('auth');
// Route::put('/penulis/{id}', [PenulisController::class, 'editData'])->name('penulis.edit')->middleware('auth');
// Route::delete('/penulis/{id}', [PenulisController::class, 'hapusData'])->name('penulis.hapus')->middleware('auth');

Route::controller(PenulisController::class)->group(function () {
    Route::get('/penulis', 'index')->name('penulis.index')->middleware('auth:petugas');
    Route::get('/penulis/{id}/edit', 'edit')->name('penulis.update')->middleware('auth:petugas');
    Route::post('/penulis', 'store')->name('penulis.store')->middleware('auth:petugas');
    Route::put('/penulis/{id}', 'update')->name('penulis.edit')->middleware('auth:petugas');
    Route::delete('/penulis/{id}', 'delete')->name('penulis.hapus')->middleware('auth:petugas');
});

//Route Kategori
// Route::get('/kategori', [KategoriController::class, 'showData'])->name('kategori.index')->middleware('auth');
// Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.update')->middleware('auth');
// Route::post('/kategori', [KategoriController::class, 'tambahData'])->name('kategori.tambah')->middleware('auth');
// Route::put('/kategori/{id}', [KategoriController::class, 'editData'])->name('kategori.edit')->middleware('auth');
// Route::delete('/kategori/{id}', [KategoriController::class, 'hapusData'])->name('kategori.hapus')->middleware('auth');

Route::controller(KategoriController::class)->group(function () {
    Route::get('/kategori', 'index')->name('kategori.index')->middleware('auth:petugas');
    Route::get('/kategori/{id}/edit', 'edit')->name('kategori.update')->middleware('auth:petugas');
    Route::post('/kategori', 'store')->name('kategori.store')->middleware('auth:petugas');
    Route::put('/kategori/{id}', 'update')->name('kategori.edit')->middleware('auth:petugas');
    Route::delete('/kategori/{id}', 'delete')->name('kategori.hapus')->middleware('auth:petugas');
});


Route::controller(PeminjamanController::class)->group(function () {
    Route::get('/peminjaman', 'index')->name('pinjam.index')->middleware('auth:petugas');
    Route::get('/peminjaman/tambahdata', 'create')->name('pinjam.create')->middleware('auth:petugas');
    Route::post('/peminjaman', 'store')->name('pinjam.store')->middleware('auth:petugas');
});




//Route Login
// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);
// Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
});

Route::controller(LogoutController::class)->group(function () {
    Route::post('/logout', 'logout')->name('logout');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth']);
