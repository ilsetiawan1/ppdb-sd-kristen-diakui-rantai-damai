<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CasisController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PanitiaController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\BiayaDaftarUlangController;
use App\Http\Controllers\PanitiaDaftarUlangController;
use App\Http\Controllers\CalonSiswaDaftarUlangController;

// Public routes
Route::get('/', [PengaturanController::class, 'index'])->name('login');
Route::post('/registrasi', [LoginController::class, 'registrasi'])->name('registrasi');
Route::post('/loginproses', [LoginController::class, 'loginproses'])->name('loginproses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

    // Calon Siswa routes
    Route::middleware(['role:Calon Siswa'])->group(function () {
        Route::get('/beranda/casis', [BerandaController::class, 'berandacasis'])->name('berandacasis');
        Route::get('/beranda/profil casis', [ProfilController::class, 'casis'])->name('casis');
        Route::get('/beranda/pendaftaran', [CasisController::class, 'form'])->name('formcasis');
        Route::get('/beranda/pendaftaran/isi', [CasisController::class, 'daftar'])->name('daftarcasis');
        Route::post('/beranda/pendaftaran/proses', [CasisController::class, 'proses'])->name('prosescasis');

        Route::get('/beranda/pembayaran', [PembayaranController::class, 'pembayaran'])->name('pembayaran');
        Route::post('/pelunasan', [PembayaranController::class, 'pelunasan'])->name('pelunasan');
        Route::get('/beranda/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
        Route::get('/unduh pengumuman/{id}', [PengumumanController::class, 'unduh'])->name('unduh');

        Route::get('/daftar-ulang', [CalonSiswaDaftarUlangController::class, 'show'])->name('calon_siswa.daftar_ulang.show');
        Route::post('/daftar-ulang', [CalonSiswaDaftarUlangController::class, 'store'])->name('calon_siswa.daftar_ulang.store');
        Route::get('/daftar-ulang/print', [CalonSiswaDaftarUlangController::class, 'print'])->name('calon_siswa.daftar_ulang.print');
    });

    // Panitia routes
    Route::middleware(['role:Panitia'])->group(function () {
        Route::get('/beranda/panitia', [BerandaController::class, 'berandapanitia'])->name('berandapanitia');
        Route::get('/beranda/profil panitia', [ProfilController::class, 'panitia'])->name('panitia');
        Route::get('/panitia/evaluasi-seleksi', [PanitiaController::class, 'nilai'])->name('nilai');
        Route::get('/panitia/input_nilai/{id}', [PanitiaController::class, 'input'])->name('input');
        Route::post('/panitia/simpan/{id}', [PanitiaController::class, 'simpan'])->name('simpan');
        Route::delete('/panitia/hapus/{id}', [PanitiaController::class, 'hapus'])->name('hapus');

        // Laporan
        Route::prefix('laporan')->group(function () {
            Route::get('pendaftaran', [LaporanController::class, 'pendaftaran'])->name('pendaftaran');
            Route::get('pembayaran', [LaporanController::class, 'pembayaran'])->name('pembayaran');
            Route::get('hasil casis', [LaporanController::class, 'hasilcasis'])->name('hasilcasis');
            Route::get('siswa lulus', [LaporanController::class, 'diterimacasis'])->name('diterimacasis');
            Route::get('siswa/tidak lulus', [LaporanController::class, 'gagalcasis'])->name('gagalcasis');
        });

        Route::prefix('unduh')->group(function () {
            Route::get('data casis', [LaporanController::class, 'datacasis'])->name('datacasis');
            Route::get('hasil casis', [LaporanController::class, 'unduhhasil'])->name('unduhhasil');
            Route::get('siswa lulus', [LaporanController::class, 'unduhditerima'])->name('unduhditerima');
            Route::get('siswa tidak lulus', [LaporanController::class, 'unduhgagal'])->name('unduhgagal');
            Route::get('laporan pendaftaran', [LaporanController::class, 'unduhpendaftaran'])->name('unduhpendaftaran');
            Route::get('laporan pembayaran', [LaporanController::class, 'unduhpembayaran'])->name('unduhpembayaran');
        });

        // Removed daftar-ulang routes from panitia
    });

    // Admin routes
    Route::middleware(['role:Admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [BerandaController::class, 'index'])->name('admin.dashboard');
        Route::get('/profil', [ProfilController::class, 'admin'])->name('admin.profil');

        // Casis management
        Route::prefix('data/casis')->group(function () {
            Route::get('/', [CasisController::class, 'index'])->name('indexcasis');
            Route::get('edit/{id}', [CasisController::class, 'edit'])->name('editdata');
            Route::post('update/{id}', [CasisController::class, 'update'])->name('updatedata');
            Route::get('detail/{id}', [CasisController::class, 'detail'])->name('detailcasis');
            Route::delete('delete/{id}', [CasisController::class, 'deletecasis'])->name('deletecasis');
        });

        // Panitia management
        Route::prefix('data/panitia')->group(function () {
            Route::get('/', [PanitiaController::class, 'index'])->name('datapanitia');
            Route::get('add', [PanitiaController::class, 'add'])->name('addpanitia');
            Route::post('proses', [PanitiaController::class, 'proses'])->name('prosespanitia');
            Route::get('edit/{id}', [PanitiaController::class, 'edit'])->name('editpanitia');
            Route::post('update/{id}', [PanitiaController::class, 'update'])->name('updatepanitia');
            Route::delete('delete/{id}', [PanitiaController::class, 'delete'])->name('deletepanitia');
        });

        // Other admin routes
        Route::get('/data/ortu', [OrangtuaController::class, 'index'])->name('dataortu');
        
        Route::prefix('pembayaran')->group(function () {
            Route::get('/', [PembayaranController::class, 'index'])->name('index');
            Route::get('/tagihan/{id}', [PembayaranController::class, 'tagihan'])->name('tagihan');
            Route::post('/proses/{id}', [PembayaranController::class, 'proses'])->name('proses');
            Route::delete('/delete/{id}', [PembayaranController::class, 'delete'])->name('delete');
        });

        // Pendaftaran
        Route::prefix('pendaftaran')->group(function () {
            Route::get('/', [PendaftaranController::class, 'index'])->name('datapendaftaran');
            Route::get('form', [PendaftaranController::class, 'formpendaftaran'])->name('formpendaftaran');
            Route::post('proses', [PendaftaranController::class, 'proses'])->name('prosespendaftaran');
            Route::get('tampil-data/{id}', [PendaftaranController::class, 'tampil'])->name('tampildata');
            Route::post('proses-data/{id}', [PendaftaranController::class, 'prosesdata'])->name('prosesdata');
        });

        // Laporan
        Route::prefix('laporan')->group(function () {
            Route::get('pendaftaran', [LaporanController::class, 'pendaftaran'])->name('admin.pendaftaran');
            Route::get('pembayaran', [LaporanController::class, 'pembayaran'])->name('admin.pembayaran');
        });

        Route::prefix('unduh')->group(function () {
            Route::get('data-casis', [LaporanController::class, 'datacasis'])->name('admin.datacasis');
            Route::get('laporan-pendaftaran', [LaporanController::class, 'unduhpendaftaran'])->name('admin.unduhpendaftaran');
            Route::get('laporan-pembayaran', [LaporanController::class, 'unduhpembayaran'])->name('admin.unduhpembayaran');
        });

        // Data Master & Pengaturan
        Route::prefix('data')->group(function () {
            Route::get('landing-page', [PengaturanController::class, 'pengaturan'])->name('photo.pengaturan');
            Route::get('pengumuman-seleksi', [PengaturanController::class, 'pengseleksi'])->name('pengumuman.pengseleksi');
            Route::post('update-status-seleksi', [PengaturanController::class, 'updateStatusSeleksi'])->name('pengumuman.updateStatusSeleksi');
            Route::get('user', [PengaturanController::class, 'datauser'])->name('beranda.datauser');
            Route::get('tahun-ajaran', [PengaturanController::class, 'tahun'])->name('beranda.tahun');
        });

        // Tahun Ajar Action
        Route::prefix('tahun-ajaran')->group(function () {
            Route::get('add', [PengaturanController::class, 'add'])->name('tahun.add');
            Route::post('simpan', [PengaturanController::class, 'simpan'])->name('tahun.simpan');
            Route::get('edit/{id}', [PengaturanController::class, 'edit'])->name('tahun.edit');
            Route::post('update/{id}', [PengaturanController::class, 'update'])->name('tahun.update');
            Route::delete('delete/{id}', [PengaturanController::class, 'delete'])->name('tahun.delete');
        });

        Route::prefix('verifikasi-daftar-ulang')->group(function () {
            Route::get('/', [PanitiaDaftarUlangController::class, 'index'])->name('admin.daftar_ulang.index');
            Route::get('/{id}', [PanitiaDaftarUlangController::class, 'show'])->name('admin.daftar_ulang.show');
            Route::put('/{id}', [PanitiaDaftarUlangController::class, 'update'])->name('admin.daftar_ulang.update');
        });

        Route::prefix('biaya-daftar-ulang')->group(function () {
            Route::get('/', [BiayaDaftarUlangController::class, 'index'])->name('biaya-daftar-ulang.index');
            Route::post('/', [BiayaDaftarUlangController::class, 'store'])->name('biaya-daftar-ulang.store');
            Route::put('/{id}', [BiayaDaftarUlangController::class, 'update'])->name('biaya-daftar-ulang.update');
            Route::delete('/{id}', [BiayaDaftarUlangController::class, 'destroy'])->name('biaya-daftar-ulang.destroy');
        });
    });

    Route::post('/photos/upload', [PengaturanController::class, 'upload'])->name('photo.upload');
});
