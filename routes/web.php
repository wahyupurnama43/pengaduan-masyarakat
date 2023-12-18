<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TanggapanController;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
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

Route::name('auth.')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginStore'])->name('loginStore');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('registerStore');

    Route::get('logout', LogoutController::class)->name('logout')->middleware('auth');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::name('dashboard.')->middleware('admin')->group(function () {
        Route::get('/akun', [DashboardController::class, 'akun'])->name('akun');
        Route::post('/akun', [DashboardController::class, 'storeUser'])->name('storeUser');
        Route::post('/akun/{id}', [DashboardController::class, 'updateUser'])->name('updateUser');
        Route::delete('/akun/{id}', [DashboardController::class, 'deteleUser'])->name('deteleUser');
    });

    Route::name('pengaduan.')->group(function () {
        Route::post('/pengaduan', [PengaduanController::class, 'store'])->name("store");
    });

    Route::name('tanggapan.')->group(function () {
        Route::post('/tanggapan/{id}', [TanggapanController::class, 'store'])->name("store");
    });
});

Route::get('/send-email', function () {
    $data = [
        'name' => 'Syahrizal As',
        'body' => 'Testing Kirim Email di Santri Koding',
    ];

    Mail::to('wahyupurnama434@gmail.com')->send(new SendEmail($data));

    dd("Email Berhasil dikirim.");
});
