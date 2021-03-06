<?php

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

Route::get('/', 'Beranda_controller@index');

Route::get('/barang/show/{barang_id}', 'Beranda_controller@show');

Route::get('/test', function(){
	echo 'test';
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Add To Cart
Route::get('/add-to-cart/{id}', 'Beranda_controller@addToCart');

// Get cart/show cart views
Route::get('/shopping-cart', 'Cart_controller@index');
// Empty Cart
Route::get('/shopping-cart/destroy', 'Cart_controller@destroy');
// add qty Cart
Route::get('/shopping-cart/update/{id}', 'Cart_controller@update');
// kurangi qty item in cart
Route::get('/shopping-cart/kurangi/{id}', 'Cart_controller@kurangi');

// Barang berdasarkan kategori ========================================
Route::get('/barang/kategori/{kategori_id}', 'Beranda_controller@kategori');

Route::group(['middleware'=>'auth'], function(){
	// Checkout
	Route::get('/shopping-cart/checkout', 'Cart_controller@checkout');
	// bayar
	Route::post('/shopping-cart/bayar', 'Cart_controller@bayar');
	// Invoice
	Route::get('/invoice', 'Invoice_controller@index');
	// List Invoice
	Route::get('/invoice/list', 'Invoice_controller@list');
	// Detail Invoice
	Route::get('/invoice/detail/{pesanan_id}', 'Invoice_controller@detail');

	// Konfirmasi Pembayaran ==============================================
	Route::get('/konfirmasi', 'Konfirmasi_controller@index');
	Route::post('/konfirmasi/store', 'Konfirmasi_controller@store');
});