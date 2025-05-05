<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syarat extends Model
{
    use HasFactory;

    protected $table = 'syarat';

    protected $fillable = [
        'nama',
        'batas_hutang',
        'cash_on_delivery',
        'persentase_diskon',
        'periode_diskon',
    ];
}
