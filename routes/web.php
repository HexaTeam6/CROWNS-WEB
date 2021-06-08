<?php

use App\Http\Controllers\Admin\AdminController;
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

Route::middleware('auth.role:admin')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/logout', [AdminController::class, 'logout'])->name('logout');
});