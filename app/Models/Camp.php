<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function scopeNonUserCamps($query) {
        $user_id = Auth::user()->id;

        return $query->leftJoin('camps_payments', function ($join) use ($user_id) {
            $join->on('camps.id', '=', 'camps_payments.camp_id')
            ->whereRaw('camps_payments.user_id = ? AND (camps_payments.validated IS NULL OR camps_payments.validated = 1)', [$user_id]);
        })->select('camps.*')
        ->whereNull('camps_payments.user_id')
        ->groupBy('camps.id', 'camps.location', 'camps.entries', 'camps.cost', 'camps.date', 'camps.created_at', 'camps.updated_at')
        ->get();
    }

    public function scopeUserCamps($query){
        $user_id = Auth::user()->id;

        return $query->join('camps_payments', 'camps.id', '=', 'camps_payments.camp_id')
        ->select('camps.*')
        ->whereRaw('camps_payments.user_id = ? AND (camps_payments.validated IS NULL OR camps_payments.validated = 1)', [$user_id])
        ->groupBy('camps.id', 'camps.location', 'camps.entries', 'camps.cost', 'camps.date', 'camps.created_at', 'camps.updated_at')
        ->get();
    }
}
