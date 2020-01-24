<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'is_blocked',

    ];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/users/'.$this->getKey());
    }
}
