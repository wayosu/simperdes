<?php

use App\Http\Controllers\DesaKelurahanController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisPeraturanController;
use App\Http\Controllers\KabupatenKotaController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\PeraturanDesaController;
use App\Http\Controllers\PerdeController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\ReviewPeraturanDesaController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [FrontController::class, 'welcome'])->name('welcome');

Route::get('/unduh/{filename}', [FrontController::class, 'unduh'])->name('unduh');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role-access:superadmin'])->group(function () {
    Route::get('/superadmin', [HomeController::class, 'index'])->name('superadmin.dashboard');
    Route::prefix('superadmin')->name('superadmin.')->group(function () {
    
        Route::controller(ProvinsiController::class)->group(function () {
            Route::get('/provinsi', 'index')->name('provinsi');
            Route::get('/provinsi/create', 'create')->name('provinsi.create');
            Route::post('/provinsi/store', 'store')->name('provinsi.store');
            Route::delete('/provinsi/{id}', 'destroy')->name('provinsi.destroy');
            Route::get('/provinsi/{id}/edit', 'edit')->name('provinsi.edit');
            Route::put('/provinsi/{id}', 'update')->name('provinsi.update');
        });
    
        Route::controller(KabupatenKotaController::class)->group(function () {
            Route::get('/kabupaten-kota', 'index')->name('kabupaten-kota');
            Route::get('/kabupaten-kota/create', 'create')->name('kabupaten-kota.create');
            Route::post('/kabupaten-kota/store', 'store')->name('kabupaten-kota.store');
            Route::delete('/kabupaten-kota/{id}', 'destroy')->name('kabupaten-kota.destroy');
            Route::get('/kabupaten-kota/{id}/edit', 'edit')->name('kabupaten-kota.edit');
            Route::put('/kabupaten-kota/{id}', 'update')->name('kabupaten-kota.update');
        });
    
        Route::controller(KecamatanController::class)->group(function () {
            Route::get('/kecamatan', 'index')->name('kecamatan');
            Route::get('/kecamatan/create', 'create')->name('kecamatan.create');
            Route::post('/kecamatan/store', 'store')->name('kecamatan.store');
            Route::delete('/kecamatan/{id}', 'destroy')->name('kecamatan.destroy');
            Route::get('/kecamatan/{id}/edit', 'edit')->name('kecamatan.edit');
            Route::put('/kecamatan/{id}', 'update')->name('kecamatan.update');
        });
    
        Route::controller(DesaKelurahanController::class)->group(function () {
            Route::get('/desa-kelurahan', 'index')->name('desa-kelurahan');
            Route::get('/desa-kelurahan/create', 'create')->name('desa-kelurahan.create');
            Route::post('/desa-kelurahan/store', 'store')->name('desa-kelurahan.store');
            Route::delete('/desa-kelurahan/{id}', 'destroy')->name('desa-kelurahan.destroy');
            Route::get('/desa-kelurahan/{id}/edit', 'edit')->name('desa-kelurahan.edit');
            Route::put('/desa-kelurahan/{id}', 'update')->name('desa-kelurahan.update');
        });
    
        Route::controller(DesaKelurahanController::class)->group(function () {
            Route::get('/desa-kelurahan', 'index')->name('desa-kelurahan');
            Route::get('/desa-kelurahan/create', 'create')->name('desa-kelurahan.create');
            Route::post('/desa-kelurahan/store', 'store')->name('desa-kelurahan.store');
            Route::delete('/desa-kelurahan/{id}', 'destroy')->name('desa-kelurahan.destroy');
            Route::get('/desa-kelurahan/{id}/edit', 'edit')->name('desa-kelurahan.edit');
            Route::put('/desa-kelurahan/{id}', 'update')->name('desa-kelurahan.update');
        });
    
        Route::controller(JenisPeraturanController::class)->group(function () {
            Route::get('/jenis-peraturan', 'index')->name('jenis-peraturan');
            Route::get('/jenis-peraturan/create', 'create')->name('jenis-peraturan.create');
            Route::post('/jenis-peraturan/store', 'store')->name('jenis-peraturan.store');
            Route::delete('/jenis-peraturan/{id}', 'destroy')->name('jenis-peraturan.destroy');
            Route::get('/jenis-peraturan/{id}/edit', 'edit')->name('jenis-peraturan.edit');
            Route::put('/jenis-peraturan/{id}', 'update')->name('jenis-peraturan.update');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('/users', 'index')->name('users');
            Route::get('/users/create', 'create')->name('users.create');
            Route::post('/users/store', 'store')->name('users.store');
            Route::delete('/users/{id}', 'destroy')->name('users.destroy');
            Route::get('/users/{id}/edit', 'edit')->name('users.edit');
            Route::put('/users/{id}', 'update')->name('users.update');
            Route::get('/pengaturan-akun', 'pengaturan')->name('pengaturan');
            Route::put('/pengaturan-akun/{id}', 'update_bio')->name('pengaturan.update-bio');
            Route::put('/pengaturan-akun/update-password/{id}', 'update_password')->name('pengaturan.update-password');
        });

        Route::controller(PeraturanDesaController::class)->group(function () {
            Route::get('/peraturan-desa', 'index')->name('peraturan-desa');
            Route::get('/peraturan-desa/{id}/detail', 'show')->name('peraturan-desa.detail');
            Route::get('/peraturan-desa/{id}/hasil-tinjauan', 'hasil_review')->name('hasil-review');
            Route::post('/peraturan-desa/{id}/detail-tinjauan', 'detail_review')->name('detail-review');
        });

        Route::controller(ReviewPeraturanDesaController::class)->group(function () {
            Route::get('/tinjauan-peraturan-desa', 'index')->name('review-peraturan-desa');
            Route::get('/tinjauan-peraturan-desa/{id}/detail', 'show')->name('review-peraturan-desa.detail');
            Route::delete('/tinjauan-peraturan-desa/{id}', 'destroy')->name('review-peraturan-desa.destroy');
        });

        Route::controller(TentangKamiController::class)->group(function () {
            Route::get('/tentang-kami', 'index')->name('tentang-kami');
            Route::put('/tentang-kami/{id}', 'update')->name('tentang-kami.update');
        });
    });
});

Route::middleware(['auth', 'role-access:admin_desakel'])->group(function () {
    Route::get('/admin-desa-kelurahan', [HomeController::class, 'index'])->name('admin-desakel.dashboard');
    Route::prefix('admin-desakel')->name('admin-desakel.')->group(function () {

        Route::controller(PeraturanDesaController::class)->group(function () {
            Route::get('/peraturan-desa', 'index')->name('peraturan-desa');
            Route::get('/peraturan-desa/create', 'create')->name('peraturan-desa.create');
            Route::post('/peraturan-desa/store', 'store')->name('peraturan-desa.store');
            Route::get('/peraturan-desa/{id}/detail', 'show')->name('peraturan-desa.detail');
            Route::delete('/peraturan-desa/{id}', 'destroy')->name('peraturan-desa.destroy');
            Route::get('/peraturan-desa/{id}/edit', 'edit')->name('peraturan-desa.edit');
            Route::put('/peraturan-desa/{id}', 'update')->name('peraturan-desa.update');

            Route::post('/peraturan-desa/{id}', 'status_review')->name('hasil-review.status');
            Route::get('/peraturan-desa/{id}/hasil-tinjauan', 'hasil_review')->name('hasil-review');
            Route::post('/peraturan-desa/{id}/detail-tinjauan', 'detail_review')->name('detail-review');

            Route::post('/peraturan-desa/{id}/batal-periksa', 'batal_periksa')->name('batal-periksa');
            Route::post('/peraturan-desa/{id}/lanjut-evaluasi', 'lanjut_evaluasi')->name('lanjut-evaluasi');
            Route::get('/peraturan-desa/{id}/evaluasi', 'evaluasi')->name('evaluasi');
            Route::put('/peraturan-desa/{id}/evaluasi', 'evaluasi_update')->name('evaluasi.update');
            Route::post('/peraturan-desa/{id}/selesai', 'selesai')->name('selesai');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('/pengaturan-akun', 'pengaturan')->name('pengaturan');
            Route::put('/pengaturan-akun/{id}', 'update_bio')->name('pengaturan.update-bio');
            Route::put('/pengaturan-akun/update-password/{id}', 'update_password')->name('pengaturan.update-password');
        });

        Route::controller(PerdeController::class)->group(function () {
            Route::get('/perdes', 'index')->name('perdes');
            Route::get('/perdes/create', 'create')->name('perdes.create');
            Route::post('/perdes/store', 'store')->name('perdes.store');
            Route::get('/perdes/{id}/detail', 'show')->name('perdes.detail');
            Route::delete('/perdes/{id}', 'destroy')->name('perdes.destroy');
            Route::get('/perdes/{id}/edit', 'edit')->name('perdes.edit');
            Route::put('/perdes/{id}', 'update')->name('perdes.update');
        });
    });
});


// Route::middleware(['auth', 'role-access:admin_kecamatan'])->group(function () {
//     Route::get('/admin-kecamatan', [HomeController::class, 'index'])->name('admin-kecamatan.dashboard');
//     Route::prefix('admin-kecamatan')->name('admin-kecamatan.')->group(function () {
//     });
// });

Route::middleware(['auth', 'role-access:admin_kabkota'])->group(function () {
    Route::get('/admin-kabupaten-kota', [HomeController::class, 'index'])->name('admin-kabkota.dashboard');
    Route::prefix('admin-kabupaten-kota')->name('admin-kabkota.')->group(function () {

        Route::controller(PeraturanDesaController::class)->group(function () {
            Route::get('/peraturan-desa', 'index')->name('peraturan-desa');
            Route::get('/peraturan-desa/{id}/detail', 'show')->name('peraturan-desa.detail');
            Route::post('/perturan-desa/{id}', 'status')->name('peraturan-desa.status');
        });

        Route::controller(ReviewPeraturanDesaController::class)->group(function () {
            Route::get('/tinjauan-peraturan-desa', 'index')->name('review-peraturan-desa');
            Route::get('/peraturan-desa/{id}/tinjauan', 'review')->name('peraturan-desa.review');
            Route::post('/tinjauan-peraturan-desa/store', 'store')->name('review-peraturan-desa.store');
            Route::get('/tinjauan-peraturan-desa/{id}/detail', 'show')->name('review-peraturan-desa.detail');
            Route::delete('/tinjauan-peraturan-desa/{id}', 'destroy')->name('review-peraturan-desa.destroy');
            Route::get('/tinjauan-peraturan-desa/{id}/edit', 'edit')->name('review-peraturan-desa.edit');
            Route::put('/tinjauan-peraturan-desa/{id}', 'update')->name('review-peraturan-desa.update');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('/pengaturan-akun', 'pengaturan')->name('pengaturan');
            Route::put('/pengaturan-akun/{id}', 'update_bio')->name('pengaturan.update-bio');
            Route::put('/pengaturan-akun/update-password/{id}', 'update_password')->name('pengaturan.update-password');
        });
    });
});

Route::middleware(['auth', 'role-access:admin_kecamatan'])->group(function () {
    Route::get('/admin-kecamatan', [HomeController::class, 'index'])->name('admin-kecamatan.dashboard');
    Route::prefix('admin-kecamatan')->name('admin-kecamatan.')->group(function () {

        Route::controller(PeraturanDesaController::class)->group(function () {
            Route::get('/peraturan-desa', 'index')->name('peraturan-desa');
            Route::get('/peraturan-desa/{id}/detail', 'show')->name('peraturan-desa.detail');
            Route::post('/perturan-desa/{id}', 'status')->name('peraturan-desa.status');
        });

        Route::controller(ReviewPeraturanDesaController::class)->group(function () {
            Route::get('/tinjauan-peraturan-desa', 'index')->name('review-peraturan-desa');
            Route::get('/peraturan-desa/{id}/tinjauan', 'review')->name('peraturan-desa.review');
            Route::post('/tinjauan-peraturan-desa/store', 'store')->name('review-peraturan-desa.store');
            Route::get('/tinjauan-peraturan-desa/{id}/detail', 'show')->name('review-peraturan-desa.detail');
            Route::delete('/tinjauan-peraturan-desa/{id}', 'destroy')->name('review-peraturan-desa.destroy');
            Route::get('/tinjauan-peraturan-desa/{id}/edit', 'edit')->name('review-peraturan-desa.edit');
            Route::put('/tinjauan-peraturan-desa/{id}', 'update')->name('review-peraturan-desa.update');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('/pengaturan-akun', 'pengaturan')->name('pengaturan');
            Route::put('/pengaturan-akun/{id}', 'update_bio')->name('pengaturan.update-bio');
            Route::put('/pengaturan-akun/update-password/{id}', 'update_password')->name('pengaturan.update-password');
        });
    });
});

Route::middleware(['auth', 'role-access:mitra'])->group(function () {
    Route::get('/mitra', [HomeController::class, 'index'])->name('mitra.dashboard');
    Route::prefix('mitra')->name('mitra.')->group(function () {

        Route::controller(PeraturanDesaController::class)->group(function () {
            Route::get('/peraturan-desa', 'index')->name('peraturan-desa');
            Route::get('/peraturan-desa/{id}/detail', 'show')->name('peraturan-desa.detail');
            Route::post('/perturan-desa/{id}', 'status')->name('peraturan-desa.status');
        });

        Route::controller(ReviewPeraturanDesaController::class)->group(function () {
            Route::get('/tinjauan-peraturan-desa', 'index')->name('review-peraturan-desa');
            Route::get('/peraturan-desa/{id}/tinjauan', 'review')->name('peraturan-desa.review');
            Route::post('/tinjauan-peraturan-desa/store', 'store')->name('review-peraturan-desa.store');
            Route::get('/tinjauan-peraturan-desa/{id}/detail', 'show')->name('review-peraturan-desa.detail');
            Route::delete('/tinjauan-peraturan-desa/{id}', 'destroy')->name('review-peraturan-desa.destroy');
            Route::get('/tinjauan-peraturan-desa/{id}/edit', 'edit')->name('review-peraturan-desa.edit');
            Route::put('/tinjauan-peraturan-desa/{id}', 'update')->name('review-peraturan-desa.update');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('/pengaturan-akun', 'pengaturan')->name('pengaturan');
            Route::put('/pengaturan-akun/{id}', 'update_bio')->name('pengaturan.update-bio');
            Route::put('/pengaturan-akun/update-password/{id}', 'update_password')->name('pengaturan.update-password');
        });
    });
});