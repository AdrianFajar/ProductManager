<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/home', 'HomeController@index')->name('home');

Route::name('admin.')->group(function (){
    Route::get('/profile/{id}', 'ProfileController@index')->name('profile');
    Route::post('/profile/{id}', 'ProfileController@update')->name('profile.update');
});

Route::resource('product-category', 'ProductCategoryController');
Route::resource('product', 'ProductController')->except('store');
Route::post('/add-product', 'ProductController@store')->name('add-product');

Route::resource('history', 'TransactionHistoryController');
Route::get('/stock-in', 'TransactionController@stockIn')->name('stock-in');
Route::get('/stock-out', 'TransactionController@stockOut')->name('stock-out');
Route::post('/stock-in/store', 'TransactionController@storeStockIn')->name('stock-in.store');
Route::post('/stock-out/store', 'TransactionController@storeStockOut')->name('stock-out.store');