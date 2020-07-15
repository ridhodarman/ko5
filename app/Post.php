<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
                            'nama',
                            'jenis_posts',
                            'alamat',
                            'status_posts',
                            'deskripsi',
                            'kelurahan_id',
                            'cover',
                            'lat',
                            'lng',
                            'pemilik_id'
    ];
}
