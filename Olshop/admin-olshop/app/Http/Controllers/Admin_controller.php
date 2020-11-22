<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin_controller extends Controller
{
    public function index()
    {
    	$title = 'Dashboard';
    	$barang = \DB::table('barang')->get();
    	$jumlah_barang = count($barang);

    	$pesanan = \DB::table('konfirmasi')->get();
    	$jumlah_pesanan = count($pesanan);

    	return view('dashboard', compact('title', 'jumlah_pesanan', 'jumlah_barang'));
    }

    public function logout()
    {
    	\Auth::logout();

    	return redirect('login');
    }
}
