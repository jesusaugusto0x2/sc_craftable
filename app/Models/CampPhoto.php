<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampPhoto extends Model
{
    protected $table = 'camps_photos';

    protected $fillable = [
        'url', 'camp_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/camp-photos/'.$this->getKey());
    }
}
