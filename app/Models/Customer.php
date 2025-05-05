<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'bkg_customer_id',
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
            $latestUser = self::orderBy('bkg_customer_id', 'desc')->first();
            $nextID = $latestUser ? intval(substr($latestUser->bkg_customer_id, 3)) + 1 : 1;
            $model->bkg_customer_id = 'BC-' . sprintf("%04d", $nextID);

            // Ensure the bkg_customer_id is unique
            while (self::where('bkg_customer_id', $model->bkg_customer_id)->exists()) {
                $nextID++;
                $model->bkg_customer_id = 'BC-' . sprintf("%04d", $nextID);
            }
        });
    }
}
