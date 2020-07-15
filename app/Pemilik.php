<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    protected $fillable = ['nama', 'kontak', 'deskripsi', 'user_id'];
}
