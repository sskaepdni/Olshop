<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    public $primaryKey = 'pesanan_id';
    public $timestamps = false;

    public function status()
    {
    	return $this->belongsTo('App\Models\Status_invoice', 'status_invoice_id', 'status_invoice_id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'users_id', 'users_id');
    }
}
