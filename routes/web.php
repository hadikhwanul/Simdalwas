<?php

use App\Models\PokokTemuan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LHPController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DraftController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenanggungController;
use App\Http\Controllers\TindakController;

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

Route::middleware('auth')->group(function () {

    // Routes for the settings resource
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('/settings/edit', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('settings/change-password', [SettingsController::class, 'changePassword'])->name('settings.change-password');
    Route::put('settings/change-password', [SettingsController::class, 'updatePassword'])->name('settings.update-password');


    route::POST('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:IRBAN|DALNIS|Anggota|SEKRETARIS|INSPEKTUR|Admin|SuperAdmin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::resource('lhp', LHPController::class)->parameters([
        'lhp' => 'draft:slug'
    ]);

    Route::resource('laporan', LaporanController::class);
});

Route::middleware(['auth', 'role: Tamu|Penanggung Jawab|SEKRETARIS|Admin|SuperAdmin'])->group(function () {
    route::get('pengembalian-dana', [PenanggungController::class, 'daftartagih'])->name('daftar.tagih');
    route::get('pengembalian-dana/daftar-bayar/{tagihan:slug}', [PenanggungController::class, 'daftarpembayaran'])->name('daftar.bayar');
    route::get('pengembalian-dana/daftar-bayar/{tagihan:slug}/pembayaran', [PenanggungController::class, 'formbayar'])->name('form.bayar');
    Route::post('pengembalian-dana/daftar-bayar/{tagihan:slug}/pembayaran', [PenanggungController::class, 'storebayar'])->name('store.bayar');
    Route::get('pengembalian-dana/daftar-bayar/{tagihan:slug}/pembayaran/{bayaranslug:slug}', [PenanggungController::class, 'formeditbayar'])->name('edit.bayar');
    Route::put('pengembalian-dana/daftar-bayar/{tagihan:slug}/pembayaran/{bayaranslug:slug}', [PenanggungController::class, 'updatebayar'])->name('update.bayar');
    Route::delete('pengembalian-dana/daftar-bayar/{tagihan:slug}/pembayaran/{bayaranslug:slug}', [PenanggungController::class, 'destroypembayaran'])->name('destroy.bayar');

    route::get('pengembalian-dana/daftar-validasi/{tagihan:slug}', [PenanggungController::class, 'daftarvalidasi'])->name('daftar.valid');
    route::get('pengembalian-dana/daftar-validasi/{tagihan:slug}/validasi/{bayaranslug:slug}', [PenanggungController::class, 'formvalidasi'])->name('form.validasi');
    route::put('pengembalian-dana/daftar-validasi/{tagihan:slug}/validasi/{bayaranslug:slug}', [PenanggungController::class, 'validasipembayaran'])->name('update.validasi');
});


Route::middleware(['auth', 'role:SuperAdmin'])->group(function () {
    Route::resource('account-center', AccountController::class);
});

Route::middleware(['auth', 'role:IRBAN|DALNIS|Anggota|Admin|SuperAdmin'])->group(function () {
    Route::resource('draft-lhp', DraftController::class)->parameters([
        'draft-lhp' => 'draft:slug'
    ]);
});

Route::middleware(['auth', 'role:IRBAN|DALNIS|SEKRETARIS|INSPEKTUR|Admin|SuperAdmin'])->group(function () {
    Route::resource('review-draft-lhp', ReviewController::class);
    Route::put('review-dalnis/{review:slug}', [ReviewController::class, 'dalnis'])->name('review.dalnis');
    Route::put('review-irban/{review:slug}', [ReviewController::class, 'irban'])->name('review.irban');
    Route::put('review-sekretaris/{review:slug}', [ReviewController::class, 'sekretaris'])->name('review.sekretaris');
    Route::put('review-inspektur/{review:slug}', [ReviewController::class, 'inspektur'])->name('review.inspektur');
});

Route::middleware(['auth', 'role:SEKRETARIS|Sub. Evaluasi & Pelaporan|Admin|SuperAdmin'])->group(function () {
    route::get('temuan-lhp/{draft:slug}', [LHPController::class, 'temuan'])->name('lhp.temuan');
    route::get('temuan-lhp/{draft:slug}/tambah-temuan', [LHPController::class, 'tambahtemuan'])->name('tambah.temuan');
    Route::post('temuan-lhp/{draft:slug}/tambah-temuan', [LHPController::class, 'storetemuan'])->name('temuan.store');
    Route::get('temuan-lhp/{draft:slug}/edit-temuan/{temuan}', [LHPController::class, 'edittemuan'])->name('temuan.edit');
    Route::post('temuan-lhp/{draft:slug}/edit-temuan/{temuan}', [LHPController::class, 'updatetemuan'])->name('temuan.update');
    Route::delete('/temuan-lhp/{draft:slug}/hapus-temuan/{temuan}', [LHPController::class, 'destroytemuan'])->name('temuan.destroy');
    route::get('temuan-lhp/{draft:slug}/export-excel', [LHPController::class, 'exportExcel'])->name('excel.temuan');

    route::get('tindak-lanjut', [TindakController::class, 'index'])->name('tindak.index');
    route::get('tindak-lanjut/{rekomendasi:slug}/tambah-tindak', [TindakController::class, 'create'])->name('tambah.tindak');
    route::post('tindak-lanjut/{rekomendasi:slug}/tambah-tindak', [TindakController::class, 'store'])->name('store.tindak');
    route::get('tindak-lanjut/{tindak:slug}/daftar-penanggung', [TindakController::class, 'daftartagih'])->name('daftar.pj');
    route::get('tindak-lanjut/{tindak:slug}/tambah-penanggung', [TindakController::class, 'penanggungcreate'])->name('tambah.pj');
    route::post('tindak-lanjut/{tindak:slug}/tambah-penanggung', [TindakController::class, 'penanggungstore'])->name('store.pj');
    Route::get('tindak-lanjut/{tindak:slug}/edit-penanggung/{tagihanSlug:slug}', [TindakController::class, 'penanggungedit'])->name('edit.pj');
    Route::put('tindak-lanjut/{tindak:slug}/edit-penanggung/{tagihanSlug:slug}', [TindakController::class, 'penanggungupdate'])->name('update.pj');
    Route::delete('tindak-lanjut/{tindak:slug}/hapus-penanggung/{tagihanSlug:slug}', [TindakController::class, 'penanggungsdestroy'])->name('destroy.pj');

    Route::resource('penanggung-jawab', PenanggungController::class);
});



// Admin Login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'aunthenticate']);