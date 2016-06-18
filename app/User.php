<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'dni', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function headquarter()
    {
        return $this->belongsTo(Headquarter::class);
    }

    public function state()
    {
        return $this->hasOne(State::class);
    }

    public function loan()
    {
        return $this->hasMany(Loan::class);
    }

    public function reserve()
    {
        return $this->hasMany(Reserve::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function issue()
    {
        return $this->hasMany(Issue::class);
    }

}
