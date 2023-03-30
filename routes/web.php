<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
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

Route::controller(HomeController::class)->name('home.')->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate')->name('login.authenticate')->middleware('guest');

    Route::post('/logout', 'logout')->name('login.logout')->middleware('auth');
});

Route::controller(RegisterController::class)->name('register.')->middleware('guest')->group(function () {
    Route::get('/register', 'index')->name('index');
    Route::post('/register', 'store')->name('store');
});

Route::controller(ChangePasswordController::class)->name('changePassword.')->middleware('auth')->group(function () {
    Route::get('/change-password', 'index')->name('index');
    Route::post('/change-password', 'update')->name('update');
});

Route::controller(DashboardController::class)->name('dashboard.')->middleware('auth')->group(function () {
    Route::get('/dashboard', 'index')->name('index');
});

Route::controller(SiswaController::class)->name('siswa.')->middleware('auth')->group(function () {
    Route::get('/dashboard/siswa', 'index')->name('index');
    Route::get('/dashboard/tambah-siswa', 'create')->name('create');

    Route::post('/dashboard/tambah-siswa', 'store')->name('store');
    Route::delete('/dashboard/siswa/{id}', 'destroy')->name('destroy');

    Route::get('/dashboard/ubah-siswa/{id}/edit', 'edit')->name('edit');
    Route::put('/dashboard/siswa/{id}', 'update')->name('update');
});
