<?php

use App\Http\Controllers\AdminController;
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

Route::get('/category',Category::class);
Route::get('/product',Product::class);
Route::get('/dashboard',Dashboard::class);