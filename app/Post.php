<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  //  by default it is pointing to table posts and its primary key is set to column id . to cahnge it we shall define protected properties as follows.

//   protected $table = 'meraTable';

//   protected $primary = 'admin_id';

// but here we are using the default values.

protected $fillable = ['title','content','is_admin'];
}
