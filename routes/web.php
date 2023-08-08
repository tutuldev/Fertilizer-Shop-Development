<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\indexController;
use App\Http\Controllers\Backend\chartController;
use App\Http\Controllers\Backend\tableController;

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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// custom

// by default with out controller start
// Route::get('/back', function () {
//     return view('backend.index');
// });

// Route::get('/tables', function () {
//     return view('backend.tables');
// });
// Route::get('/charts', function () {
//     return view('backend.charts');
// });
// by default with out controller end


// custom route with controller

// Route::get('/back', [App\Http\Controllers\Backend\indexController::class, 'index'])->name('backs');
Route::get('/back', [indexController::class, 'index'])->name('backs');
Route::get('/charts', [chartController::class, 'chart'])->name('charts');
Route::get('/tables', [tableController::class, 'table'])->name('tables');
