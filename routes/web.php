<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Livewire\Category;
use App\Livewire\Dashboard;
use App\Livewire\Product;
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

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/category',Category::class);
    Route::get('/product',Product::class);
    Route::get('/dashboard',Dashboard::class);
});
Route::get('',[AuthController::class,'login'])->name('user.login');
Route::get('/user/register',[AuthController::class,'register'])->name('user.register');
Route::post('/user/login',[AuthController::class,'postLogin'])->name('user.login-post');
Route::post('/user/register',[AuthController::class,'postRegister'])->name('user.register-post');
Route::post('/user/logout',[AuthController::class,'logout'])->name('user.logout');