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

Route::group(['middleware'=>'auth'], function(){
	Route::get('/keluar', 'Admin_controller@logout');

	Route::get('/', 'Admin_controller@index');

	Route::get('/base64', function(){
		$nama = \DB::table('base64')->value('nama');
		$hasil = base64_decode($nama);
		dd($hasil);
	});

	// Master Barang ================================================================
	Route::get('/barang', 'Barang_controller@index');
	Route::get('/barang/habis', 'Barang_controller@habis');

	// create barang
	Route::get('/barang/create', 'Barang_controller@create');

	// store barang baru
	Route::post('/barang/store', 'Barang_controller@store');

	// edit barang
	Route::get('/barang/edit/{barang_id}', 'Barang_controller@edit');

	// update barang
	Route::post('/barang/update/{barang_id}', 'Barang_controller@update');

	// Hapus Barang
	Route::get('/delete/barang/{barang_id}', 'Barang_controller@delete');

	// Show Barang
	Route::get('/barang/show/{barang_id}', 'Barang_controller@show');
	// Barang Habis
	Route::get('/barang/habis', 'Barang_controller@habis');
	// ===============================================================================

	// Master Kategori Barang ============================================================
	Route::get('/kategori', 'Kategori_controller@index');
	// Edit Kategori
	Route::get('/kategori/edit/{kategori_id}', 'Kategori_controller@edit');
	// Update Kategori
	Route::post('/kategori/update/{id}', 'Kategori_controller@update');
	// Hapus Kategori
	Route::get('/kategori/delete/{id}', 'Kategori_controller@delete');
	// Kategori Create
	Route::get('/kategori/create', 'Kategori_controller@create');
	// Kategori Store
	Route::post('/kategori/store', 'Kategori_controller@store');

	// =============== KONFIRMASI PEMBAYARAN ===========================================================
	Route::get('/konfirmasi', 'Konfirmasi_controller@index');
	// Detail Konfirmasi
	Route::get('/konfirmasi/detail/{id}', 'Konfirmasi_controller@detail');
	// Terima Konfirmasi
	Route::get('/konfirmasi/terima/{pesanan_id}', 'Konfirmasi_controller@terima');
	// Tolak Konfirmasi
	Route::get('/konfirmasi/tolak/{pesanan_id}', 'Konfirmasi_controller@tolak');

	// ========================= LIST PESANAN =================================
	Route::get('/pesanan', 'Pesanan_controller@index');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
