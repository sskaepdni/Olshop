<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\Models\Pesanan;
use App\Models\Konfirmasi;

class Pesanan_controller extends Controller
{
    public function index()
    {
    	$title = 'List semua pesanan';
    	$konfirmasis = Konfirmasi::orderBy('konfirmasi_id', 'desc')->get();

    	return view('pesanan.pesanan_index', compact('title', 'konfirmasis'));
    }
}
