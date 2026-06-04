<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\WalkelController;
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
    Route::get('/kelola-user', [AdminController::class, 'kelolaUser'])->name('kelolaUser.admin');

    // KELOLA KELAS
    Route::get('/kelas', [KelasController::class, 'listKelas'])->name('kelas');
    Route::get('/kelas/create', [KelasController::class, 'createKelas'])->name('kelas.create');
    Route::get('/kelas/edit', [KelasController::class, 'editKelas'])->name('kelas.edit');
    Route::post('/kelas/store', [KelasController::class, 'storeKelas'])->name('kelas.store');
    Route::post('/kelas/update/{id}', [KelasController::class, 'updateKelas'])->name('kelas.update');
    Route::post('/kelas/delete/{id}', [KelasController::class, 'deleteKelas'])->name('kelas.delete');
    Route::post('/kelas/{id}/generate-code', [AdminController::class, 'generateClassCode'])->name('generate-code');

    // KELOLA TRANSAKSI - DAFTAR
    Route::get('/data-transaksi', [AdminController::class, 'daftarTransaksi'])->name('admin.daftar-transaksi');
    Route::get('/transaksi/detail/{id}', [AdminController::class, 'detailTransaksi'])->name('admin.detail-transaksi');

    // KELOLA TRANSAKSI - CRUD
    Route::get('/transaksi/tambah', [AdminController::class, 'tambahTransaksi'])->name('admin.tambah-transaksi');
    Route::post('/transaksi/simpan', [AdminController::class, 'simpanTransaksi'])->name('admin.simpan-transaksi');
    Route::get('/transaksi/edit/{id}', [AdminController::class, 'editTransaksi'])->name('admin.edit-transaksi');
    Route::post('/transaksi/update/{id}', [AdminController::class, 'updateTransaksi'])->name('admin.update-transaksi');
    Route::delete('/transaksi/hapus/{id}', [AdminController::class, 'hapusTransaksi'])->name('admin.hapus-transaksi');

    // KELOLA TRANSAKSI - APPROVAL
    Route::post('/transaksi/approve/{id}', [AdminController::class, 'approveTransaksi'])->name('admin.approve-transaksi');
    Route::post('/transaksi/reject/{id}', [AdminController::class, 'rejectTransaksi'])->name('admin.reject-transaksi');

    // STATISTIK & EXPORT
    Route::get('/transaksi/statistik', [AdminController::class, 'statistikTransaksi'])->name('admin.statistik-transaksi');
    Route::get('/transaksi/export', [AdminController::class, 'exportTransaksi'])->name('admin.export-transaksi');
});

Route::middleware(['auth', 'role:bendahara'])->prefix('bendahara')->group(function () {

    //dashboard
    Route::get('/dashboard', [BendaharaController::class, 'dashboard'])
        ->name('bendahara.dashboard');

    //kas masuk ya
    Route::get('/kasMasuk', [BendaharaController::class, 'kasMasuk'])
        ->name('bendahara.kas_masuk');

    Route::get('/kasMasuk/create', [KasController::class, 'createKasMasuk'])
        ->name('bendahara.kas_masuk.create');

    Route::get('/kasMasuk/edit', [KasController::class, 'editKasMasuk'])
        ->name('bendahara.kas_masuk.edit');

    Route::post('/kasMasuk/store', [KasController::class, 'storeKasMasuk'])
        ->name('bendahara.kas_masuk.store');

    Route::post('/kasMasuk/update/{id}', [KasController::class, 'updateKasMasuk'])
        ->name('bendahara.kas_masuk.update');

    Route::post('/kasMasuk/delete', [KasController::class, 'deleteKasMasuk'])
        ->name('bendahara.kas_masuk.delete');


    //kas pengeluaran
    Route::get('/kasKeluar', [BendaharaController::class, 'kasKeluar'])
        ->name('bendahara.kas_keluar');

    Route::get('/kasKeluar/create', [KasController::class, 'createKasKeluar'])
        ->name('bendahara.kas_keluar.create');

    Route::get('/kasKeluar/edit', [KasController::class, 'editKasKeluar'])
        ->name('bendahara.kas_keluar.edit');

    Route::post('/kasKeluar/store', [KasController::class, 'storeKasMasuk'])
        ->name('bendahara.kas_keluar.store');

    Route::post('/kasKeluar/update/{id}', [KasController::class, 'updateKasKeluar'])
        ->name('bendahara.kas_keluar.update');

    Route::post('/kasKeluar/delete', [KasController::class, 'deleteKasKeluar'])
        ->name('bendahara.kas_keluar.delete');


    // transaksi
    Route::get('/transaksi', [BendaharaController::class, 'transaksi'])
        ->name('bendahara.transaksi');

    // tagihan
    Route::get('/tagihan', [BendaharaController::class, 'tagihan'])
        ->name('bendahara.tagihan');

    Route::get('/tagihan/create', [BendaharaController::class, 'createTagihan'])
        ->name('bendahara.tagihan.create');

    Route::get('/tagihan/edit', [BendaharaController::class, 'editTagihan'])
        ->name('bendahara.tagihan.edit');

    Route::post('/tagihan/store', [BendaharaController::class, 'storeTagihan'])
        ->name('bendahara.tagihan.store');

    Route::delete('/tagihan/{id}', [BendaharaController::class, 'destroyTagihan'])
        ->name('bendahara.tagihan.destroy');


    // laporan
Route::get('/laporan', [BendaharaController::class, 'laporan'])
    ->name('bendahara.laporan');

// profile
Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('bendahara.profile');

// pengaturan
Route::get('/pengaturan', [BendaharaController::class, 'settings'])
    ->name('bendahara.pengaturan');

});

Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {

    Route::get('/index', [SiswaController::class, 'index'])
        ->name('siswa.index');

    Route::patch('/notifikasi/read/{id}', [SiswaController::class, 'readNotification'])
        ->name('siswa.notifikasi.read');

    Route::get('/siswa.notifikasi', [SiswaController::class, 'allNotifications'])->name('siswa.notifikasi');

    Route::get('/riwayat', [SiswaController::class, 'riwayat'])
        ->name('siswa.riwayat');

    Route::get('/tunggakan', [SiswaController::class, 'tunggakan'])
        ->name('siswa.tunggakan');

    Route::get('/detail-tunggakan/{id}', [SiswaController::class, 'detailTagihan'])
        ->name('siswa.detail_tagihan');

    Route::get('/laporan-kas', [SiswaController::class, 'laporanKas'])
        ->name('siswa.laporan_kas');

    Route::get('/transaksi', [SiswaController::class, 'pembayaran'])
        ->name('siswa.transaksi');

    Route::post('/transaksi/store', [SiswaController::class, 'simpanPembayaran'])
        ->name('siswa.transaksi.store');

    Route::get('/detail-transaksi/{id}', [SiswaController::class, 'detailPembayaran'])
        ->name('siswa.detail_transaksi');

    Route::post('/logout', [SiswaController::class, 'logout'])
        ->name('siswa.logout');
});

Route::middleware(['auth', 'role:wali_kelas'])->prefix('wali')->group(function () {
    Route::get('/dashboard', [WalkelController::class, 'dashboard'])->name('wali.dashboard');
    Route::post('/siswa/{id}/jadikan-bendahara', [WalkelController::class, 'jadikanBendahara'])->name('wali.jadikan-bendahara');
    Route::get('/rekap-pembayaran', [WalkelController::class, 'rekapPembayaran'])->name('wali.rekap-pembayaran');
    Route::get('/tunggakan', [WalkelController::class, 'tunggakan'])->name('wali.tunggakan');
    Route::get('/pengeluaran', [WalkelController::class, 'pengeluaran'])->name('wali.pengeluaran');
    Route::get('/transaksi-kas', [WalkelController::class, 'transaksiKas'])->name('wali.transaksi-kas');
    Route::get('/rekap-pembayaran', [WalkelController::class, 'rekapPembayaran'])->name('wali.rekap-pembayaran');
    Route::get('/tunggakan', [WalkelController::class, 'tunggakan'])->name('wali.tunggakan');
});
require __DIR__ . '/auth.php';
