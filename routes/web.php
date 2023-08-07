<?php

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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// custom

Route::get('/bc', function () {
    return view('backend.layouts.app');
});
Route::get('/index', function () {
    return view('backend.index');
});
Route::get('/tab', function () {
    return view('backend.tables');
});
Route::get('/ch', function () {
    return view('backend.charts');
});
