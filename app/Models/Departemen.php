<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $table = 'departemen';

    protected $fillable = [
        'departemen_id',
        'nama_departemen',
        'nama_kontak',
        'tipe_departemen',
        'dihentikan',
        'deskripsi',
    ];

    // /** generate id */
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $latestUser = self::orderBy('departemen_id', 'desc')->first();
            $prefix = 'GMP-';
            $nextID = $latestUser ? intval(substr($latestUser->departemen_id, strlen($prefix))) : 1;
            $model->departemen_id = $prefix . sprintf("%04d", $nextID);
            while (self::where('departemen_id', $model->departemen_id)->exists()) {
                $nextID++;
                $model->departemen_id = $prefix . sprintf("%04d", $nextID);
            }
        });
    }

}
