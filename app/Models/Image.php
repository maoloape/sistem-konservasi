<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['konservasi_id', 'filename'];

    public function konservasi()
    {
        return $this->belongsTo(konservasi::class, 'konservasi_id');
    }
}
