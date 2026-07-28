<?php

use Illuminate\Support\Facades\Artisan;
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
use App\Http\Controllers\Admin\KknAnggotaController;
use App\Http\Controllers\Admin\KknProkerController;
use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PesanKontakController;
use App\Http\Controllers\Admin\PetaRumahController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EmailVerificationController;

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
Route::get('/data', [PublicController::class, 'data'])->name('data');
Route::get('/peta', [PublicController::class, 'peta'])->name('peta');
Route::get('/peta/rumah-geojson', [PublicController::class, 'petaRumahGeojson'])->name('peta.rumah.geojson');
Route::get('/kalender', [PublicController::class, 'kalender'])->name('kalender');
Route::get('/kkn', [PublicController::class, 'kkn'])->name('kkn');


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

    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['signed'])->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])->middleware(['throttle:6,1'])->name('verification.send');

    // Protected admin routes
    Route::middleware(['auth', 'verified.email'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::middleware('role:admin')->group(function () {
            Route::resource('users', UserController::class);
        });

        // Berita
        Route::resource('berita', BeritaController::class)
            ->parameters(['berita' => 'berita']);

        // Wisata
        Route::resource('wisata', WisataController::class)
            ->parameters(['wisata' => 'wisata']);

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

        // KKN
        Route::resource('kkn-anggota', KknAnggotaController::class);
        Route::resource('kkn-proker', KknProkerController::class);

        // Statistik
        Route::resource('statistik', StatistikController::class);

        // Pengaturan
        Route::get('pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
        Route::post('pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');

        // Pesan Kontak
        Route::resource('pesan-kontak', PesanKontakController::class);
        Route::patch('pesan-kontak/{pesanKontak}/read', [PesanKontakController::class, 'markRead'])->name('pesan-kontak.read');

        // Peta Rumah
        Route::resource('peta-rumah', PetaRumahController::class);
        Route::get('peta-rumah-geojson', [PetaRumahController::class, 'geojson'])->name('peta-rumah.geojson');
    });
});

// Install route - untuk setup awal di shared hosting (hapus setelah dipakai)
Route::get('/setup-install', function (\Illuminate\Http\Request $request) {
    // Validasi parameter key untuk mengamankan proses setup
    $expectedKey = config('auth.admin.setup_key');
    if (!$expectedKey || $request->query('key') !== $expectedKey) {
        abort(403, 'Akses ditolak. Silakan sertakan query parameter key yang valid.');
    }

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

// Route khusus untuk menjalankan migrasi baru di hosting tanpa reset data seeder
Route::get('/run-migration', function (\Illuminate\Http\Request $request) {
    $expectedKey = config('auth.admin.setup_key');
    if (!$expectedKey || $request->query('key') !== $expectedKey) {
        abort(403, 'Akses ditolak. Silakan sertakan query parameter key yang valid.');
    }
    try {
        Artisan::call('migrate', ['--force' => true]);
        return '<h1 style="font-family:sans-serif;color:green">✅ Update migrasi database berhasil!</h1>';
    } catch (\Exception $e) {
        return '<h1 style="font-family:sans-serif;color:red">❌ Error: '.$e->getMessage().'</h1>';
    }
});

// Route untuk memindahkan/menduplikasi file upload ke folder public jika tidak ada symlink
Route::get('/fix-storage', function () {
    $storageLink = public_path('storage');
    $src = storage_path('app/public/uploads');
    $dst = public_path('storage/uploads');

    // Hapus jika ada link/symlink atau file rusak dengan nama 'storage' di folder public
    if (is_link($storageLink) || (!is_dir($storageLink) && file_exists($storageLink))) {
        @unlink($storageLink);
        @rmdir($storageLink);
    }

    // Buat folder fisik public/storage jika belum ada
    if (!file_exists($storageLink)) {
        @mkdir($storageLink, 0777, true);
    }

    if (!file_exists($src)) {
        return 'Folder ' . $src . ' tidak ditemukan. Silakan upload gambar baru di admin panel, atau buat folder tersebut.';
    }

    if (!file_exists($dst)) {
        @mkdir($dst, 0777, true);
    }

    $copyFolder = function ($src, $dst) use (&$copyFolder) {
        $dir = opendir($src);
        @mkdir($dst, 0777, true);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $copyFolder($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    };

    $copyFolder($src, $dst);
    return '✅ Berhasil memperbaiki storage! File upload berhasil disalin ke folder fisik public/storage/uploads!';
});

