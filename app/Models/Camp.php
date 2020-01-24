<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
    protected $fillable = [
        'location',
        'entries',
        'cost',
        'date',

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
        return url('/admin/camps/'.$this->getKey());
    }

    /** Relations */
    public function payments () {
        return $this->hasMany('App\Models\CampPayment');
    }

    public function photos () {
        return $this->hasMany('App\Models\CampPhoto');
    }
}
