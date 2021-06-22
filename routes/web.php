<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Konsumen\DeleteController as KonsumenDeleteController;
use App\Http\Controllers\Admin\Konsumen\UpdateController as KonsumenUpdateController;
use App\Http\Controllers\Admin\Konsumen\ViewController as KonsumenViewController;
use App\Http\Controllers\Admin\Penjahit\DeleteController as PenjahitDeleteController;
use App\Http\Controllers\Admin\Penjahit\UpdateController as PenjahitUpdateController;
use App\Http\Controllers\Admin\Penjahit\ViewController as PenjahitViewController;
use App\Http\Controllers\Admin\Katalog\CreateController as KatalogCreateController;
use App\Http\Controllers\Admin\Katalog\ViewController as KatalogViewController;
use App\Http\Controllers\Admin\Katalog\UpdateController as KatalogUpdateController;
use App\Http\Controllers\Admin\Katalog\DeleteController as KatalogDeleteController;
use App\Http\Controllers\Admin\Pesanan\ViewController as PesananViewController;
use App\Http\Controllers\Admin\Pesanan\UpdateController as PesananUpdateController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UpdateController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect()->route('login');
})->name('landing');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth.role:admin'], function (){
    Route::get('', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'view'])->name('profile');
    Route::put('/profile', [UpdateController::class, 'updatePut'])->name('profile.update_put');
    
    Route::get('/manage-akun', [AdminController::class, 'table'])->name('manage-akun');
    Route::group(['prefix' => 'konsumen'], function (){
        Route::get('/view/{id}', [KonsumenViewController::class, 'update'])->name('konsumen.update');
        Route::put('/update/{id}', [KonsumenUpdateController::class, 'updatePut'])->name('konsumen.update_put');
        Route::delete('/delete', [KonsumenDeleteController::class, 'delete'])->name('konsumen.delete');
    });
    Route::group(['prefix' => 'penjahit'], function () {
        Route::get('/view/{id}', [PenjahitViewController::class, 'update'])->name('penjahit.update');
        Route::put('/update/{id}', [PenjahitUpdateController::class, 'updatePut'])->name('penjahit.update_put');
        Route::delete('/delete', [PenjahitDeleteController::class, 'delete'])->name('penjahit.delete');
    });

    Route::group(['prefix' => 'katalog'], function () {
        Route::get('', [KatalogViewController::class, 'view'])->name('katalog');

        Route::get('/create-kategori', [KatalogCreateController::class, 'createKategori'])->name('katalog.kategori.create');
        Route::post('/create-kategori', [KatalogCreateController::class, 'storeKategori'])->name('katalog.kategori.store');
        Route::get('/view-kategori/{id}', [KatalogViewController::class, 'viewKategori'])->name('katalog.kategori.view');
        Route::put('/update-kategori/{id}', [KatalogUpdateController::class, 'updatePutKategori'])->name('katalog.kategori.update_put');
        Route::delete('/delete-kategori', [KatalogDeleteController::class, 'deleteKategori'])->name('katalog.kategori.delete');

        Route::get('/create-baju', [KatalogCreateController::class, 'createBaju'])->name('katalog.baju.create');
        Route::post('/create-baju', [KatalogCreateController::class, 'storeBaju'])->name('katalog.baju.store');
        Route::get('/view-baju/{id}', [KatalogViewController::class, 'viewBaju'])->name('katalog.baju.view');
        Route::put('/update-baju/{id}', [KatalogUpdateController::class, 'updatePutBaju'])->name('katalog.baju.update_put');
        Route::delete('/delete-baju', [KatalogDeleteController::class, 'deleteBaju'])->name('katalog.baju.delete');
    });

    Route::group(['prefix' => 'pesanan'], function () {
        Route::get('', [PesananViewController::class, 'view'])->name('pesanan');
        Route::put('', [PesananUpdateController::class, 'validasi'])->name('pesanan.validate');

        Route::get('detail-pembayaran/{id}', [PesananViewController::class, 'viewPembayaran'])->name('pesanan.view.pembayaran');
        Route::put('detail-pembayaran/{id}', [PesananUpdateController::class, 'validasi'])->name('pesanan.validate.pembayaran');
    });
});