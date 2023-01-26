<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\LaboController;
use App\Http\Controllers\users\ProfilController;
use App\Http\Controllers\users\UserController;
use App\Http\Controllers\whatsapp\WhatsappController;
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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/profils')->group(function () {
        Route::get('', [ProfilController::class, 'index'])->name('profil.index');
        Route::get('/create', [ProfilController::class, 'create'])->name('profil.create');
        Route::post('', [ProfilController::class, 'store'])->name('profil.store');
        Route::get('/{profil}/edit', [ProfilController::class, 'edit'])->name('profil.edit');
        Route::put('/{profil}', [ProfilController::class, 'update'])->name('profil.update');
        Route::post('/{profil}/operation', [ProfilController::class, 'operation'])->name('profil.operation');
    });

    Route::prefix('/users')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('', [UserController::class, 'store'])->name('user.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('user.update');
        Route::get('/{user}/edit-password', [UserController::class, 'editPassword'])->name('user.edit-password');
        Route::put('/{user}/reset', [UserController::class, 'resetPassword'])->name('user.password-reset');
        Route::post('/{user}/operation', [UserController::class, 'operation'])->name('user.operation');
    });

    Route::prefix('/whatsapp')->group(function () {
        Route::get('', [WhatsappController::class, 'index'])->name('whatsapp.index');
        Route::post('/send', [WhatsappController::class, 'sendMessage'])->name('whatsapp.send-message');
    });
});

Route::get('/404', function () {
    return view('errors.404', ['title' => trans('messages.404')]);
});

Route::get('/labo', [LaboController::class, 'index'])->name('labo.index');

//Route::any('{url}', function () {
//    return redirect('/404');
//})->where('url', '.*');
