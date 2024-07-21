<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class konservasi extends Model
{
    use HasFactory;

    protected $table = 'konservasi';

    protected $fillable = [
        'das',
        'sub_das',
        'kabupaten',
        'kecamatan',
        'desa',
        'blok',
        'bt',
        'ls',
        'dokumentasi',
        'jenis_batu',
        'keterangan',
        'create_in',
    ];
}
