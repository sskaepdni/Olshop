<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konfirmasi extends Model
{
    protected $table = 'konfirmasi';
    public $primaryKey = 'konfirmasi_id';
    public $timestamps = false;

    public function user()
    {
    	return $this->belongsTo('App\User', 'users_id', 'users_id');
    }

    public function pesanan()
    {
    	return $this->belongsTo('App\Models\Pesanan', 'pesanan_id', 'pesanan_id');
    }
}
