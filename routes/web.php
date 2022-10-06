<?php

use App\Http\Controllers\CategoryController as C;
use App\Http\Controllers\MovieController as M;
use App\Http\Controllers\HomeController as H;
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



Auth::routes();

Route::get('/', [H::class, 'homeList'])->name('home')->middleware('gate:home');
Route::put('/rate/{movie}', [H::class, 'rate'])->name('rate')->middleware('gate:user');

Route::prefix('category')->name('c_')->group(function () {
    Route::get('/', [C::class, 'index'])->name('index')->middleware('gate:user');
    Route::get('/create', [C::class, 'create'])->name('create')->middleware('gate:admin');
    Route::post('/create', [C::class, 'store'])->name('store')->middleware('gate:admin');
    Route::get('/show/{category}', [C::class, 'show'])->name('show')->middleware('gate:user');
    Route::delete('/delete/{category}', [C::class, 'destroy'])->name('delete')->middleware('gate:admin');
    Route::get('/edit/{category}', [C::class, 'edit'])->name('edit')->middleware('gate:admin');
    Route::put('/edit/{category}', [C::class, 'update'])->name('update')->middleware('gate:admin');
});

Route::prefix('movie')->name('m_')->group(function () {
    Route::get('/', [M::class, 'index'])->name('index')->middleware('gate:user');
    Route::get('/create', [M::class, 'create'])->name('create')->middleware('gate:admin');
    Route::post('/create', [M::class, 'store'])->name('store')->middleware('gate:admin');
    Route::get('/show/{movie}', [M::class, 'show'])->name('show')->middleware('gate:user');
    Route::delete('/delete/{movie}', [M::class, 'destroy'])->name('delete')->middleware('gate:admin');
    Route::get('/edit/{movie}', [M::class, 'edit'])->name('edit')->middleware('gate:admin');
    Route::put('/edit/{movie}', [M::class, 'update'])->name('update')->middleware('gate:admin');
});
