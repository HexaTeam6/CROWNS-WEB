<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Konsumen\DeleteController as KonsumenDeleteController;
use App\Http\Controllers\Admin\Konsumen\UpdateController as KonsumenUpdateController;
use App\Http\Controllers\Admin\Konsumen\ViewController as KonsumenViewController;
use App\Http\Controllers\Admin\Penjahit\DeleteController as PenjahitDeleteController;
use App\Http\Controllers\Admin\Penjahit\UpdateController as PenjahitUpdateController;
use App\Http\Controllers\Admin\Penjahit\ViewController as PenjahitViewController;
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

Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::get('/login', [AdminController::class, 'loginPage'])->name('login');
Route::post('/login', [AdminController::class, 'login'])->name('login.post');
Route::get('/register', [AdminController::class, 'registerPage'])->name('register');
Route::post('/register', [AdminController::class, 'register'])->name('register.post');

// Route::middleware('auth.role:admin')->group(function() {
//     Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
//     Route::post('/dashboard/logout', [AdminController::class, 'logout'])->name('logout');
// });

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth.role:admin'], function (){
    Route::get('', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'konsumen'], function (){
        Route::get('/update/{id}', [KonsumenViewController::class, 'update'])->name('konsumen.update');
        Route::put('/update/{id}', [KonsumenUpdateController::class, 'updatePut'])->name('konsumen.update_put');
        Route::delete('/delete', [KonsumenDeleteController::class, 'delete'])->name('konsumen.delete');
    });
    
    Route::group(['prefix' => 'penjahit'], function () {
        Route::get('/update/{id}', [PenjahitViewController::class, 'update'])->name('penjahit.update');
        Route::put('/update/{id}', [PenjahitUpdateController::class, 'updatePut'])->name('penjahit.update_put');
        Route::delete('/delete', [PenjahitDeleteController::class, 'delete'])->name('penjahit.delete');
    });
});
