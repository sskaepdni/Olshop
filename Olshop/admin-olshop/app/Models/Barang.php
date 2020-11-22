<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    public $primaryKey = 'barang_id';
    public $timestamps = false;

    public function kategori()
    {
    	return $this->belongsTo('App\Models\Kategori', 'kategori_id', 'kategori_id');
    }

    public function gambar()
    {
    	return $this->hasOne('App\Models\Photo', 'barang_id', 'barang_id');
    }

    public function statuss()
    {
        return $this->belongsTo('App\Models\Status', 'status_id', 'status_id');
    }
}
