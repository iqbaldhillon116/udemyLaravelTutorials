<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function post(){
            //this function is for one to one relationship created in section 11 
        return $this->hasOne('App\Post');
    }

    public function posts(){
        //this funciton is used to return one to many relationships
        return $this->hasMany('App\Post');

    }

    public function roles(){

        return $this->belongsToMany('App\Role')->withPivot('created_at');

        //to customize tables and columns

        // return $this->belongsToMany('App\Role','user_role','user_id','role_id');
    }


    public function photos(){

        return $this->morphMany('App\Photo','imageable');
  
      }
}
