<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampsPayment extends Model
{
    protected $fillable = [
        'reference',
        'photo',
        'date',
        'validated',
        'method_id',
        'camp_id',
        'user_id',
        'bank_id',

    ];


    protected $dates = [
        'date',
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/camps-payments/'.$this->getKey());
    }
}
