<?php

use App\Http\Controllers\API\KatalogController;
use App\Http\Controllers\API\KategoriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PembeliController;
use App\Http\Controllers\API\PenjahitController;
use App\Http\Controllers\API\PesananController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('pembeli')->group(function () {
    Route::post('login', [PembeliController::class, 'login']);
    Route::post('register', [PembeliController::class, 'register']);
    Route::get('/{id_user}', [PembeliController::class, 'profileByUsersId']);
});

Route::prefix('penjahit')->group(function () {
    Route::post('login', [PenjahitController::class, 'login']);
    Route::post('register', [PenjahitController::class, 'register']);
    Route::get('/{id_user}', [PenjahitController::class, 'profileByUsersId']);
});

Route::prefix('kategori')->group(function () {
    Route::get('/', [KategoriController::class, 'index']);
    Route::get('/{id}/katalog', [KategoriController::class, 'katalogByKategori']);
});

Route::prefix('katalog')->group(function () {
    Route::get('/', [KatalogController::class, 'index']);
    Route::get('/{id}/penjahit', [KatalogController::class, 'penjahitByKatalog']);
});

Route::prefix('pesanan')->group(function () {
    Route::middleware(['auth:api', 'checkPembeli'])->group(function () {
        Route::post('/create', [PesananController::class, 'create']);
        Route::post('/updateDetail', [PesananController::class, 'updateDetail']);
        Route::post('/uploadDesignCustom', [PesananController::class, 'uploadDesignCustom']);
        Route::post('/updateJemput', [PesananController::class, 'updateJemput']);
        Route::post('/ajukanTawar', [PesananController::class, 'ajukanTawar']);
        Route::post('/bayar', [PesananController::class, 'bayar']);
    });

    Route::middleware(['auth:api', 'checkPenjahit'])->group(function () {
        Route::post('/updateHarga', [PesananController::class, 'updateHarga']);
        Route::post('/terimaTawar', [PesananController::class, 'terimaTawar']);
        Route::post('/tolakTawar', [PesananController::class, 'tolakTawar']);
    });
});