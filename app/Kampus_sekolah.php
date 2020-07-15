<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kampus_sekolah extends Model
{
    protected $fillable = [
                            'nama',
                            'lat',
                            'lng'
    ];
}
