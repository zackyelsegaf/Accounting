<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipePelanggan extends Model
{
    use HasFactory;

    protected $table = 'tipe_pelanggan';

    protected $fillable = [
        'nama',
    ];
}
