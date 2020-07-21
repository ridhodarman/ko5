<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    protected $fillable = ['post_id', 'harga', 'pembayaran', 'keterangan'];
}
