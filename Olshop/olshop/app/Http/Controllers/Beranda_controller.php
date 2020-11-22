<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Barang;
// use App\Cart;
use Cart;

class Beranda_controller extends Controller
{
    public function index()
    {
    	$barangs = Barang::orderBy('barang_id', 'desc')->where('status_id', 1)->get();

    	return view('beranda', compact('barangs'));
    }

    public function addToCart(Request $request, $id)
    {
    	$barang = Barang::find($id);
    	Cart::add(['id'=>$barang->barang_id, 'name'=>$barang->nama, 'qty'=>1, 'price'=>$barang->harga]);

        Session::flash('pesan', 'Barang berhasil di masukkan ke keranjang');

    	// $request->session()->put('cart', $cart);
    	// dd($request->session()->get('cart'));
        // dd(Cart::content());
    	return redirect()->back();
    }

    public function kategori($kategori_id)
    {
        $barangs = Barang::orderBy('nama', 'asc')->where('kategori_id', $kategori_id)->where('status_id', 1)->get();

        return view('beranda', compact('barangs'));
    }

    public function show($barang_id)
    {
        $barang = Barang::where('barang_id', $barang_id)->first();

        return view('barang_detail', compact('barang'));
    }
}
