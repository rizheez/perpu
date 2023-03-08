<?php

use App\Models\Penulis;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PenulisController;
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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/informasi/buku', [BukuController::class, 'index'])->name('buku')->middleware('auth');
// Route::get('/data/stok', [BarangController::class, 'barang'])->name('stok')->middleware('auth');

//Route Penulis
Route::get('/penulis', [PenulisController::class, 'showData'])->name('penulis.index')->middleware('auth');
Route::get('/penulis/edit/{id}', [PenulisController::class, 'edit'])->name('penulis.update')->middleware('auth');
Route::post('/penulis', [PenulisController::class, 'tambahData'])->name('penulis.tambah')->middleware('auth');
Route::put('/penulis/{id}', [PenulisController::class, 'editData'])->name('penulis.edit')->middleware('auth');
Route::delete('/penulis/{id}', [PenulisController::class, 'hapusData'])->name('penulis.hapus')->middleware('auth');

//Route Kategori
Route::get('/kategori', [KategoriController::class, 'showData'])->name('kategori.index')->middleware('auth');
Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.update')->middleware('auth');
Route::post('/kategori', [KategoriController::class, 'tambahData'])->name('kategori.tambah')->middleware('auth');
Route::put('/kategori/{id}', [KategoriController::class, 'editData'])->name('kategori.edit')->middleware('auth');
Route::delete('/kategori/{id}', [KategoriController::class, 'hapusData'])->name('kategori.hapus')->middleware('auth');



//Route Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth']);
