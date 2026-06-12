<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\WisataController;
use App\Http\Controllers\Admin\UmkmController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\PerangkatController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\AspirasiController;
use App\Http\Controllers\Admin\DokumenController;
use App\Http\Controllers\Admin\KknAnggotaController;
use App\Http\Controllers\Admin\KknProkerController;
use App\Http\Controllers\Admin\BankSampahController;
use App\Http\Controllers\Admin\LaporanSampahController;
use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PesanKontakController;
use App\Http\Controllers\Admin\DataSampahController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/profil', [PublicController::class, 'profil'])->name('profil');
Route::get('/berita', [PublicController::class, 'berita'])->name('berita');
Route::get('/berita/{id}', [PublicController::class, 'beritaDetail'])->name('berita.detail');
Route::get('/wisata', [PublicController::class, 'wisata'])->name('wisata');
Route::get('/umkm', [PublicController::class, 'umkm'])->name('umkm');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('galeri');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [PublicController::class, 'kontakSubmit'])->name('kontak.submit');
Route::get('/aspirasi', [PublicController::class, 'aspirasi'])->name('aspirasi');
Route::post('/aspirasi', [PublicController::class, 'aspirasiSubmit'])->name('aspirasi.submit');
Route::get('/dokumen', [PublicController::class, 'dokumen'])->name('dokumen');
Route::get('/data', [PublicController::class, 'data'])->name('data');
Route::get('/peta', [PublicController::class, 'peta'])->name('peta');
Route::get('/kalender', [PublicController::class, 'kalender'])->name('kalender');
Route::get('/sitara', [PublicController::class, 'sitara'])->name('sitara');
Route::get('/kkn', [PublicController::class, 'kkn'])->name('kkn');
Route::post('/laporan-sampah', [PublicController::class, 'laporanSampahSubmit'])->name('laporan.submit');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    // Auth
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index']);

        // Berita
        Route::resource('berita', BeritaController::class);

        // Wisata
        Route::resource('wisata', WisataController::class);

        // UMKM
        Route::resource('umkm', UmkmController::class);

        // Galeri
        Route::resource('galeri', GaleriController::class);

        // Perangkat Desa
        Route::resource('perangkat', PerangkatController::class);

        // Agenda
        Route::resource('agenda', AgendaController::class);

        // Aspirasi
        Route::resource('aspirasi', AspirasiController::class);
        Route::patch('aspirasi/{aspirasi}/status', [AspirasiController::class, 'updateStatus'])->name('aspirasi.status');

        // Dokumen
        Route::resource('dokumen', DokumenController::class);

        // KKN
        Route::resource('kkn-anggota', KknAnggotaController::class);
        Route::resource('kkn-proker', KknProkerController::class);

        // Bank Sampah
        Route::resource('bank-sampah', BankSampahController::class);

        // Laporan Sampah
        Route::resource('laporan-sampah', LaporanSampahController::class);
        Route::patch('laporan-sampah/{laporan}/status', [LaporanSampahController::class, 'updateStatus'])->name('laporan-sampah.status');

        // Statistik
        Route::resource('statistik', StatistikController::class);

        // Pengaturan
        Route::get('pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
        Route::post('pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');

        // Pesan Kontak
        Route::resource('pesan-kontak', PesanKontakController::class);
        Route::patch('pesan-kontak/{pesan}/read', [PesanKontakController::class, 'markRead'])->name('pesan-kontak.read');

        // Data Sampah Bulanan
        Route::resource('data-sampah', DataSampahController::class);
    });
});

// Install route - untuk setup awal di shared hosting (hapus setelah dipakai)
Route::get('/setup-install', function () {
    if (app()->environment('production') && file_exists(storage_path('installed'))) {
        abort(404);
    }
    try {
        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true]);
        file_put_contents(storage_path('installed'), date('Y-m-d H:i:s'));
        return '<h1 style="font-family:sans-serif;color:green">✅ Instalasi berhasil! Hapus route /setup-install dari routes/web.php</h1>';
    } catch (\Exception $e) {
        return '<h1 style="font-family:sans-serif;color:red">❌ Error: '.$e->getMessage().'</h1>';
    }
});
