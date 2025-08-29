<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
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

Route::get('/', function () {
    
});
Route::get('/home',[LoginController::class, 'showLoginForm'])->name('home');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register-form');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login-form');
