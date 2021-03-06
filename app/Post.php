<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
  //  by default it is pointing to table posts and its primary key is set to column id . to change it we shall define protected properties as follows.

//   protected $table = 'meraTable';

//   protected $primary = 'admin_id';

// but here we are using the default values.

protected $fillable = ['title','content','is_admin'];

use SoftDeletes;

Protected $dates = ['deleted_at'];

    public function user(){
    //this function is used to implement the reverse relationship with the help of belongsto function
      return $this->belongsTo('App\User');
    }


    public function photos(){

      return $this->morphMany('App\Photo','imageable');

    }
    //this function is used to use many to many relationships 
    public function tags(){

      return $this->morphToMany('App\Tag','taggable');
    }

    
}
