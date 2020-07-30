<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'first_name', 'last_name', 'dob', 'phone_number','usertype_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * elequant relation with user_types table
     */
    public function usertype()
    {
        return $this->belongsTo(UserType::class);
    }

    /**
     * elequant relation with user_infos table
     * 
     */
    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }


    /**
     * elequant relation with sections table type table
     */
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
