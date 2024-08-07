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
        'kecamatan',
        'blok',
        'kabupaten',
        'desa',
        'bt',
        'ls',
        'dokumentasi',
        'jenis_batu',
        'p',
        'l',
        't',
        'volume',
        'jenis_kawat',
        'create_in',
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'konservasi_id');
    }
}
