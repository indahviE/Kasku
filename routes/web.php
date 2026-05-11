<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.admin');

    //kelola kls
    Route::get('/kelas', [KelasController::class, 'listKelas'])->name('kelas');
    Route::get('/kelas/create', [KelasController::class, 'createKelas'])->name('kelas.create');
    Route::get('/kelas/edit', [KelasController::class, 'editKelas'])->name('kelas.edit');

    Route::post('/kelas/store', [KelasController::class, 'storeKelas'])->name('kelas.store');
    Route::post('/kelas/update/{id}', [KelasController::class, 'updateKelas'])->name('kelas.update');
    Route::post('/kelas/delete/{id}', [KelasController::class, 'deleteKelas'])->name('kelas.delete');

    Route::post('/kelas/{id}/generate-code', [AdminController::class, 'generateClassCode'])->name('generate-code');
});

Route::middleware(['auth', 'role:bendahara'])->prefix('bendahara')->group(function () {

    //dashboard
    Route::get('/dashboard', function () {
        return view('bendahara.dashboard');
    })->name('bendahara.dashboard');

    //kas masuk ya
    Route::get('/kasMasuk', [KasController::class, 'viewKasMasuk'])->name('kas_masuk');
    Route::get('/kasMasuk/create', [KasController::class, 'createKasMasuk'])->name('kas_masuk.create');
    Route::get('/kasMasuk/edit', [KasController::class, 'editKasMasuk'])->name('kas_masuk.edit');

    Route::post('/kasMasuk/store', [KasController::class, 'storeKasMasuk'])->name('kas_masuk.store');
    Route::post('/kasMasuk/update/{id}', [KasController::class, 'updateKasMasuk'])->name('kas_masuk.update');
    Route::post('/kasMasuk/delete', [KasController::class, 'deleteKasMasuk'])->name('kas_masuk.delete');



    //kas pengeluaran
    Route::get('/kasKeluar', [KasController::class, 'viewKasKeluar'])->name('kas_keluar');
    Route::get('/kasKeluar/create', [KasController::class, 'createKasKeluar'])->name('kas_keluar.create');
    Route::get('/kasKeluar/edit', [KasController::class, 'editKasKeluar'])->name('kas_keluar.edit');

    Route::post('/kasKeluar/store', [KasController::class, 'storeKasMasuk'])->name('kas_keluar.store');
    Route::post('/kasKeluar/update/{id}', [KasController::class, 'updateKasKeluar'])->name('kas_keluar.update');
    Route::post('/kasKeluar/delete', [KasController::class, 'deleteKasKeluar'])->name('kas_keluar.delete');
});

    Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {

    Route::get('/index', [SiswaController::class, 'index'])
        ->name('siswa.index');

    Route::get('/riwayat', [SiswaController::class, 'riwayat'])
        ->name('siswa.riwayat');

    Route::get('/tunggakan', [SiswaController::class, 'tunggakan'])
        ->name('siswa.tunggakan');

    Route::get('/laporan-kas', [SiswaController::class, 'laporanKas'])
        ->name('siswa.laporan_kas');

    Route::get('/pembayaran', [SiswaController::class, 'pembayaran'])
        ->name('siswa.pembayaran');

    Route::post('/pembayaran/store', [SiswaController::class, 'simpanPembayaran'])
        ->name('siswa.pembayaran.store');

    Route::get('/detail-pembayaran/{id}', [SiswaController::class, 'detailPembayaran'])
        ->name('siswa.detail_pembayaran');

    Route::post('/logout', [SiswaController::class, 'logout'])
        ->name('siswa.logout');

});


require __DIR__.'/auth.php';
