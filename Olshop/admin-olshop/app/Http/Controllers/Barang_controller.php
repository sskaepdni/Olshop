<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Photo;
use App\Models\Base64;

class Barang_controller extends Controller
{
    public function index()
    {
    	$title = 'Master Barang';
    	$barangs = Barang::orderBy('nama', 'asc')->get();

    	return view('barang.barang_index', compact('title', 'barangs'));
    }

    public function habis()
    {
        $title = 'Master Barang Yang Sudah Habis';
        $barangs = Barang::orderBy('nama', 'asc')->where('stock', '=', 0)->get();

        return view('barang.barang_index', compact('title', 'barangs'));
    }

    public function show($barang_id)
    {
    	$title = 'Detail Barang';
    	$barang = Barang::where('barang_id', $barang_id)->first();

    	return view('barang.barang_show', compact('title', 'barang'));
    }

    public function create()
    {
    	$title = 'Tambah Barang';
    	$kategoris = Kategori::orderBy('nama', 'asc')->get();

    	return view('barang.barang_create', compact('title', 'kategoris'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
            'kategori_id' => 'required',
            'photo' => 'required',
            'stock' => 'required',
            'status' => 'required',
        ]);

        $barang = new Barang;
        $barang->nama = $request->nama;
        $barang->harga = $request->harga;
        $barang->keterangan = $request->keterangan;
        $barang->kategori_id = $request->kategori_id;
        $barang->stock = $request->stock;
        $barang->status_id = $request->status;
        $barang->save();

        if($files=$request->file('photo')){
            $name=$files->getClientOriginalName();
            $files->move('image',$name);

            // base64 encode
            $base64 = base64_encode(asset('image/'.$name));
            $base = new Base64;
            $base->barang_id = $barang->barang_id;
            $base->nama = $base64;
            $base->save();

            $photo = new Photo;
            $photo->barang_id = $barang->barang_id;
            $photo->nama = $name;
            $photo->save();
        }

        Session::flash('pesan', 'Data berhasil di tambah');

        return redirect('barang');
    }

    public function edit($barang_id)
    {
    	$title = 'Edit Barang';
    	$barang = Barang::where('barang_id', $barang_id)->first();
    	$kategoris = Kategori::orderBy('nama', 'asc')->get();

    	return view('barang.barang_edit', compact('title', 'barang', 'kategoris'));
    }

    public function update(Request $request, $barang_id)
    {
    	$this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
            'kategori_id' => 'required',
            'stock' => 'required',
            'status' => 'required',
        ]);

    	$barang = Barang::where('barang_id', $barang_id)->first();
    	$barang->nama = $request->nama;
    	$barang->keterangan = $request->keterangan;
    	$barang->harga = $request->harga;
    	$barang->kategori_id = $request->kategori_id;
    	$barang->stock = $request->stock;
        $barang->status_id = $request->status;
    	$barang->save();

    	if($files=$request->file('photo')){
            $name=$files->getClientOriginalName();
            $files->move('image',$name);
            
            $photo = new Photo;
            $photo->barang_id = $barang->barang_id;
            $photo->nama = $name;
            $photo->save();
        }

    	Session::flash('pesan', 'Data berhasil di Update');

    	return redirect('barang');
    }

    public function delete($barang_id)
    {
    	Barang::where('barang_id', $barang_id)->delete();
        Photo::where('barang_id', $barang_id)->delete();

    	Session::flash('pesan', 'Data berhasil di Hapus');

    	return redirect('barang');

    }
}
