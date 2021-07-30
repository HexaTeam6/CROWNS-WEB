<?php

use App\Http\Controllers\API\KatalogController;
use App\Http\Controllers\API\KategoriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PembeliController;
use App\Http\Controllers\API\PenjahitController;
use App\Http\Controllers\API\PesananController;
use App\Http\Controllers\API\PesananPembeliController;
use App\Http\Controllers\API\PesananPenjahitController;
use App\Models\Pesanan;

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
    Route::get('/{id_user}', [PembeliController::class, 'profileByUserId']);
    Route::get('/{id_user}/pesanan', [PembeliController::class, 'pesananPembeliByUserId']);
    Route::post('updateProfil', [PembeliController::class, 'updateProfil'])->middleware(['auth:api', 'checkPembeli']);
    Route::get('/id-pembeli/{id_pembeli}', [PembeliController::class, 'profileByIdPembeli']);
});

Route::prefix('penjahit')->group(function () {
    Route::post('login', [PenjahitController::class, 'login']);
    Route::post('register', [PenjahitController::class, 'register']);
    Route::get('/{id_user}', [PenjahitController::class, 'profileByUserId']);
    Route::get('/{id_user}/pesanan', [PenjahitController::class, 'pesananPenjahitByUserId']);
    Route::post('updateProfil', [PenjahitController::class, 'updateProfil'])->middleware(['auth:api', 'checkPenjahit']);
    Route::get('/id-penjahit/{id_penjahit}', [PenjahitController::class, 'profileByIdPenjahit']);
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
        Route::post('/create', [PesananPembeliController::class, 'create']);
        Route::post('/updateDetail', [PesananPembeliController::class, 'updateDetail']);
        Route::post('/uploadDesignCustom', [PesananPembeliController::class, 'uploadDesignCustom']);
        Route::post('/updateJemput', [PesananPembeliController::class, 'updateJemput']);
        Route::post('/ajukanTawar', [PesananPembeliController::class, 'ajukanTawar']);
        Route::post('/bayar', [PesananPembeliController::class, 'bayar']);
        Route::post('/rate', [PesananPembeliController::class, 'rate']);
        Route::post('/konfirmasiSelesai', [PesananPembeliController::class, 'selesai']);
    });

    Route::middleware(['auth:api', 'checkPenjahit'])->group(function () {
        Route::post('/updateHarga', [PesananPenjahitController::class, 'updateHarga']);
        Route::post('/terimaTawar', [PesananPenjahitController::class, 'terimaTawar']);
        Route::post('/tolakTawar', [PesananPenjahitController::class, 'tolakTawar']);
    });

    Route::middleware('auth:api')->group(function () {
        Route::get('/pembayaranValid', [PesananController::class, 'pembayaranValid']);
        Route::get('/pembayaranBelumValid', [PesananController::class, 'pembayaranBelumValid']);
    });

    Route::get('/{id_pesanan}', [PesananController::class, 'pesananById']);
});

Route::get('/dummy', function () {
    $response = [
        'success' => true,
        'data'    => asset('storage/'),
        'message' => '',
    ];
    return response()->json($response, 200);
});