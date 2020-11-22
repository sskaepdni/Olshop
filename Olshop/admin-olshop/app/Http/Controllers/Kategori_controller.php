<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Kategori;
use App\Models\Barang;

class Kategori_controller extends Controller
{
    public function index()
    {
    	$title = 'Master Kategori';
    	$kategoris = Kategori::orderBy('nama', 'asc')->get();

    	return view('kategori.kategori_index', compact('title', 'kategoris'));
    }

    public function create()
    {
        $title = 'Create Kategori';

        return view('kategori.kategori_create', compact('title'));
    }

    public function store(Request $request)
    {
        $kt = new Kategori;
        $kt->nama = $request->nama;
        $kt->save();

        Session::flash('pesan', 'Data berhasil ditambah');

        return redirect('kategori');
    }

    public function edit($kategori_id)
    {
    	$title = 'Edit Kategori';
    	$kategori = Kategori::where('kategori_id', $kategori_id)->first();

    	return view('kategori.kategori_edit', compact('title', 'kategori'));
    }

    public function update(Request $request, $kategori_id)
    {
    	$this->validate($request, [
    		'nama'=>'required'
    	]);

    	$kategori = Kategori::where('kategori_id', $kategori_id)->first();
    	$kategori->nama = $request->nama;
    	$kategori->save();

    	Session::flash('pesan', 'Data berhasil di Update');

    	return redirect('kategori');
    }

    public function delete($kategori_id)
    {
    	Kategori::where('kategori_id', $kategori_id)->delete();
    	Barang::where('kategori_id', $kategori_id)->delete();

    	Session::flash('pesan', 'Kategori berhasil dihapus');

    	return redirect('kategori');
    }
}