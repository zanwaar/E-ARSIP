<?php

use App\Http\Controllers\FileUploadController;
use App\Livewire\Beranda;
use App\Livewire\Bidang\Detail;
use App\Livewire\Bidang\Index;
use App\Livewire\Bidang\ListBidang;
use App\Livewire\Bidang\TambahBidang;
use App\Livewire\Counter;
use App\Livewire\Dokument\DetailSuratKeluar;
use App\Livewire\Dokument\Disposisi;
use App\Livewire\Dokument\Lainnya;
use App\Livewire\Dokument\SuratKeluar;
use App\Livewire\Dokument\SuratMasuk;
use App\Livewire\Dokument\SuratMasukAdd;
use App\Livewire\Jabatan\ListJabatan;
use App\Livewire\Pengguna\LsitPengguna;
use App\Livewire\Pengguna\Password;
use App\Livewire\Pengguna\Profile;
use App\Livewire\SuratDisposisi;
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
// Route::get('/symlink', function () {
//     $target = $_SERVER['DOCUMENT_ROOT'] . '/main-app/storage/app/public';
//     $link = $_SERVER['DOCUMENT_ROOT'] . '/storage';
//     symlink($target, $link);
//     echo "Done";
// });
Route::middleware(['auth'])->group(function () {
    Route::post('/view-pdf', [FileUploadController::class, 'downloadFile'])->name('view.pdf');
    Route::get('/Dokument', [FileUploadController::class, 'getPdf'])->name('getPdf');
    Route::post('/Dokument', [FileUploadController::class, 'getPdf'])->name('getPdf');
    Route::delete('/file-delete', [FileUploadController::class, 'deleteFile'])->name('file.delete')->middleware('role:staffAdmin');
    Route::get('/fetch', [FileUploadController::class, 'fetch'])->name('fetch');

    Route::get('/home', Beranda::class)->name('home');
    Route::get('/', Beranda::class)->name('home');
    Route::get('/surat-disposisi', SuratDisposisi::class)->name('surat.disposisi');
    Route::get('/surat-disposisi/{surat}/disposisi', Disposisi::class)->name('disposisi.id');
    Route::get('/surat/{surat}/surat-keluar', DetailSuratKeluar::class)->name('detail.suratKeluar')->middleware('role:staffAdmin');
    
    Route::prefix('dokument')->as('dokument.')->group(function () {
        Route::get('/surat-masuk', SuratMasuk::class)->name('surat-masuk')->middleware('role:staffAdmin');
        Route::get('/surat-keluar', SuratKeluar::class)->name('surat-keluar')->middleware('role:staffAdmin');
        Route::get('/lainnya', Lainnya::class)->name('lainnya')->middleware('role:staffAdmin');
    });
    Route::prefix('bidang')->as('bidang.')->group(function () {
        Route::get('/list', ListBidang::class)->name('index')->middleware('role:admin');
        Route::get('/create', TambahBidang::class)->name('create.bidang')->middleware('role:admin');
        Route::get('/{id}/detail', Detail::class)->middleware('role:admin');
    });
    Route::prefix('jabatan')->as('jabatan.')->group(function () {
        Route::get('/list', ListJabatan::class)->middleware('role:admin');
    });
    Route::prefix('pengguna')->as('pengguna.')->group(function () {
        Route::get('/list', LsitPengguna::class)->name('listpengguna')->middleware('role:admin');
    });
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/password', Password::class)->name('password');
});
