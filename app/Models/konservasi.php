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
        'desa',
        'bt',
        'ls',
        'dokumentasi',
        'jenis_batu',
        'create_in',
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'konservasi_id');
    }
}
