<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPemasok extends Model
{
    use HasFactory;

    protected $table = 'status_pemasok';

    protected $fillable = [
        'nama',
    ];

    
}
