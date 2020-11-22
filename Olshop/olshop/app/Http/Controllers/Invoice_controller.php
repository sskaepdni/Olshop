<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Auth;

use App\Models\Pesanan;
use App\Models\Pesanan_barang;

class Invoice_controller extends Controller
{
    public function index()
    {
    	$barangs = Cart::content();
    	$total = Cart::total();
    	// dd($barangs);
    	Cart::destroy();
    	$users_id = Auth::user()->users_id;


    	return view('shop.invoice', compact('barangs', 'total'));
    }

    public function list()
    {
    	$users_id = Auth::user()->users_id;
    	$pesanans = Pesanan::where('users_id', $users_id)->orderBy('pesanan_id', 'desc')->get();

    	return view('user.invoice', compact('pesanans'));
    }

    public function detail($pesanan_id)
    {
        $details = Pesanan_barang::where('pesanan_id', $pesanan_id)->get();
        $pesanan = array();

        foreach ($details as $key => $detail) {
            $detailArray = array();
            $detailArray['nama_barang'] = $detail->barang->nama;
            $detailArray['qty'] = $detail->qty;
            $detailArray['subtotal'] = $detail->subtotal;
            array_push($pesanan, $detailArray);
        }

        return response()->json([
            'hasil'=>$pesanan
        ]);
    }
}
