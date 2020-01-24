<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampPayment extends Model
{
    protected $table = 'camps_payments';

    protected $fillable = [
        'reference',
        'photo',
        'date',
        'validated',
        'method_id',
        'camp_id',
        'user_id',
        'bank_id'
    ];


    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/camp-payments/'.$this->getKey());
    }

    public function camp () {
        return $this->belongsTo('App\Models\Camp');
    }

    public function method () {
        return $this->belongsTo('App\Models\Method');
    }

    public function bank () {
        return $this->belongsTo('App\Models\Bank');
    }

    public function user () {
        return $this->belongsTo('App\Models\User');
    }
}
