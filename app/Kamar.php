<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = ['post_id', 'panjang', 'lebar', 'jumlah'];
}
