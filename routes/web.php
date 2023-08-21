<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\indexController;
use App\Http\Controllers\Backend\chartController;
use App\Http\Controllers\Backend\tableController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CompanyController;
use App\Http\Controllers\Backend\BrandController;


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
// all category

 Route::get('category/all',[CategoryController::class, 'allChategory'])->name('all.category');
 Route::get('Category/Edit/{id}',[CategoryController::class, 'editCategory'])->name('edit.category');

 Route::post('category/add',[CategoryController::class, 'addChategory'])->name('store.category');
 Route::post('store/category/{id}',[CategoryController::class, 'updateCategory'])->name('update.category');

 Route::get('softdelete/category/{id}',[CategoryController::class, 'softDelete'])->name('softDelete.category');

 Route::get('Category/restore/{id}',[CategoryController::class, 'restoreCategory'])->name('restore.category');
 Route::get('pdelete/category/{id}',[CategoryController::class, 'prmDelete'])->name('prmDelete.category');

//  all brand

Route::get('Brand/all',[BrandController::class,'allBrand'])->name('all.brand');
Route::post('Brand/add',[BrandController::class, 'addBrand'])->name('store.brand');
Route::get('Brand/Edit/{id}',[BrandController::class, 'editBrand'])->name('edit.brand');
Route::post('store/brand/{id}',[BrandController::class, 'updateBrand'])->name('update.Brand');
Route::get('Brand/Delete/{id}',[BrandController::class, 'brandDelete'])->name('Delete.Brand');

// all Company
// index
Route::get('Company/all',[CompanyController::class,'allCompany'])->name('all.company');
// insert
Route::post('Company/add',[CompanyController::class, 'addCompany'])->name('store.company');
// edit
Route::get('Company/Edit/{id}',[CompanyController::class, 'editcompany'])->name('edit.brand');
// update
Route::post('Store/Company/{id}',[CompanyController::class, 'updateCompany'])->name('update.Company');

