<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function(){
return view('welcome');
});

Route::get('/admin', function () {
    // return view('welcome');
    return "admin is here";
});


Route::get('/about' , function(){

        return "hi about page";
});

Route::get("contact",function(){

        return "hi am contact";
});

//passing variables in routes

Route::get('/posts/{id}/{name}' , function($id,$name){
return "this is post no. $id for $name";
});

//nicknaming the routes

Route::get('users/posts',array( 'as'=>'users.home' ,function(){

    $url=route('users.home');
    return $url;

}));


/*-----------
To make controller
------------
=> php artisan make:controller PostController

---------------------
*To make resource controller
--------------------
=> php artisan make:controller --resource PostsController

----------------------
*/


//--------------------------------------------------------------------------
//Routing Controllers (lecture 23)
// --------------------------------------------------------------------------

Route::get('/controllerPosts','PostsResourceController@index');

Route::get('/controllerPosts/{id}','PostsResourceController@create');

/* -------------------------------------------------------
* Using Resource routes in controller
* we can get access to all routes details by writing the following artisan command
=> php artisan route:list
*
----------------------------------------------
*/

Route::resource('/resourcepost','PostsResourceController');

/*------------------------------------
*section 6 :fundamentals of views
--------------------------------------
*/

Route::get('/contact','PostsResourceController@contact');

//passing data in views

Route::get('/posts/{id}/{name}','PostsResourceController@show_post');


/*-------------------------------
* section 7 : how to use blade templating engine in laravel
-------------------------------
*/

Route::get('/rollno','PostsResourceController@roll_no');

Route::get('/class/{id}','PostsResourceController@class');

/*-------------------------------
* section 9 : Raw Sql Queries
-------------------------------
*/

use Illuminate\Support\Facades\DB;

Route::get('/insert',function(){

    DB::insert("insert into posts(title,content,is_admin) values(?,?,?)" ,['learning laravel', 'Laravel is Awesome',1]);
    echo "one row inserted";    
});


Route::get('/read', function(){

   $result = DB::select('select * from posts where id=?' , [1]);

//    print_r($result);
//    echo "<br>";
   foreach($result as  $value){

    print_r($value->title);

   }

});


Route::get('/update',function(){

    $updated=DB::update("update posts set title='updated title' where id=?",[1]);

    return $updated;
});

Route::get('/delete' , function(){

    $deleted = DB::delete('delete from posts where id=?',[1]);

    return $deleted;
});