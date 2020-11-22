<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan_barang extends Model
{
    protected $table = 'pesanan_barang';
    public $primaryKey = 'pesanan_barang_id';
    public $timestamps = false;

    public function pesanan()
    {
    	return $this->belongsTo('App\Models\Pesanan', 'pesanan_id', 'pesanan_id');
    }

    public function barang()
    {
    	return $this->belongsTo('App\Models\Barang', 'barang_id', 'barang_id');
    }
}
