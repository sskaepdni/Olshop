<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    public $primaryKey = 'barang_id';
    public $timestamps = false;
}
