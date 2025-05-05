<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'bkg_id',
        'name',
        'room_type',
        'total_numbers',
        'date',
        'time',
        'depature_date',
        'email',
        'ph_number',
        'fileupload',
        'message',
    ];

    /** generate id */
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $latestUser = self::orderBy('bkg_id', 'desc')->first();
            $nextID = $latestUser ? intval(substr($latestUser->bkg_id, 3)) + 1 : 1;
            $model->bkg_id = 'BK-' . sprintf("%04d", $nextID);

            // Ensure the bkg_id is unique
            while (self::where('bkg_id', $model->bkg_id)->exists()) {
                $nextID++;
                $model->bkg_id = 'BK-' . sprintf("%04d", $nextID);
            }
        });
    }
}
