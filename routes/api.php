<?php

use App\Http\Controllers\API\KatalogController;
use App\Http\Controllers\API\KategoriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PembeliController;
use App\Http\Controllers\API\PenjahitController;
use App\Http\Controllers\API\PesananController;
use App\Http\Controllers\API\PesananPembeliController;
use App\Http\Controllers\API\PesananPenjualController;


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
});

Route::prefix('penjahit')->group(function () {
    Route::post('login', [PenjahitController::class, 'login']);
    Route::post('register', [PenjahitController::class, 'register']);
    Route::get('/{id_user}', [PenjahitController::class, 'profileByUserId']);
    Route::get('/{id_user}/pesanan', [PenjahitController::class, 'pesananPenjahitByUserId']);
    Route::post('updateProfil', [PenjahitController::class, 'updateProfil'])->middleware(['auth:api', 'checkPenjahit']);
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
    });

    Route::middleware(['auth:api', 'checkPenjahit'])->group(function () {
        Route::post('/updateHarga', [PesananPenjualController::class, 'updateHarga']);
        Route::post('/terimaTawar', [PesananPenjualController::class, 'terimaTawar']);
        Route::post('/tolakTawar', [PesananPenjualController::class, 'tolakTawar']);
    });

    Route::middleware('auth:api')->group(function () {
        Route::get('/pembayaranValid', [PesananController::class, 'pembayaranValid']);
        Route::get('/pembayaranBelumValid', [PesananController::class, 'pembayaranBelumValid']);
    });

    Route::get('/{id_pesanan}', [PesananController::class, 'pesananById']);
});

Route::get('/dummy', function () {
    $foto = file_get_contents(public_path('\\gallery\\images\\' . 'foto-1.jpg'));
    $foto = base64_encode($foto);
    $response = [
        'success' => true,
        'data'    => $foto,
        'message' => '',
    ];
    return response()->json($response, 200);
});