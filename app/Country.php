<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //we are going to access posts country wise through has many relationship

    public function posts(){
        //here the first table is used for geeting posts and second tables is used to get the country based users
        return $this->hasManyThrough('App\Post','App\User');
    }
}
