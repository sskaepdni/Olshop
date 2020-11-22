<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Konfirmasi;
use App\Models\Pesanan;
use App\Models\Pesanan_barang;
use App\Models\Barang;

class Konfirmasi_controller extends Controller
{
    public function index()
    {
    	$title = 'List konfirmasi pembayaran';
    	$konfirmasis = Konfirmasi::orderBy('konfirmasi_id', 'desc')->get();
    	
    	return view('konfirmasi.konfirmasi_index', compact('title', 'konfirmasis'));
    }

    public function detail($pesanan_id)
    {
    	$hasilArray = array('barang'=>array());

    	$pesanan = Pesanan::where('pesanan_id', $pesanan_id)->first();
    	$hasilArray['nama_penerima'] = $pesanan->nama_penerima;
    	$hasilArray['alamat'] = $pesanan->alamat;

    	$barangs = Pesanan_barang::where('pesanan_id', $pesanan_id)->get();

    	foreach ($barangs as $key => $barang) {
    		$barangArray = array();
    		$barangArray['nama_barang'] = $barang->barang['nama'];
    		$barangArray['qty'] = $barang->qty;
    		$barangArray['subtotal'] = number_format($barang->subtotal, 0);

    		array_push($hasilArray['barang'], $barangArray);
    	}

    	return response()->json([
    		'hasil'=>$hasilArray
    	]);
    }

    public function terima($pesanan_id)
    {
        $pesanan = Pesanan::where('pesanan_id', $pesanan_id)->first();
        $pesanan->status_invoice_id = 3;
        $pesanan->save();

        Session::flash('pesan', 'Berhasil di konfirmasi');

        return redirect('konfirmasi');
    }

    public function tolak($pesanan_id)
    {
        $pesanan = Pesanan::where('pesanan_id', $pesanan_id)->first();
        $pesanan->status_invoice_id = 4;
        $pesanan->save();

        Session::flash('pesan', 'Berhasil di konfirmasi');

        return redirect('konfirmasi');
    }
}
