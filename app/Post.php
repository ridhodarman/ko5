<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
                            'nama',
                            'jenis',
                            'alamat',
                            'status',
                            'deskripsi',
                            'kelurahan_id',
                            'cover',
                            'lat',
                            'lng',
                            'user_id'
    ];
}
