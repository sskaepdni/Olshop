<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photo';
    public $primaryKey = 'photo_id';
    public $timestamps = false;
}
