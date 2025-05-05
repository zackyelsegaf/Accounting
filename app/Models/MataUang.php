<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataUang extends Model
{
    //
    use HasFactory;

    protected $table = 'mata_uang';

    protected $fillable = [
        'nama',
        'nilai_tukar',
    ];

    public function scopeFilterByName($query, $nama)
    {
        return $query->when($nama, function ($q) use ($nama) {
            $q->where('nama', 'LIKE', '%' . $nama . '%');
        });
    }
}
