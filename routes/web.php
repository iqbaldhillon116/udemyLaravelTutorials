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


/*-------------------------------
* section 10 : Eloquent
-------------------------------
*/

use App\Post;

Route::get('/find',function(){

    $result = Post::all();

    foreach($result as $posts){
            echo $posts->title ."<br>";
    }
});

Route::get('/findone',function(){

    $result = Post::find(2);

    return $result->title;
    // foreach($result as $posts){
    //         echo $posts->title ."<br>";
    // }
});


Route::get('/findwhere' , function(){

    $result = Post::where('id',2)->orderBy('id','desc')->take(1)->get();

//  echo $result[0]->title;
return $result;
});

Route::get('/findmore',function(){

    $result = Post::findorFail(1);
 //here if we pass wrong id that dose not exists then it will give exception instead of error.

    $result2 = Post::where('users_count' , '<' , 50)->findorFail();

    return $result;
});

/*===========
| insert and update
================*/

Route::get('/basicinsert' , function(){

    $post = new Post;

    $post->title = 'Learning laravel eloquent';
    $post->content = 'learning from the best teacher';
    $post->is_admin = 1;

    $post->save();

});

Route::get('/basicinsert2' , function(){
//one way to update
    $post = Post::find(4);//instead of creating the object , find the row

    $post->title = 'Learning laravel eloquent 2';
    $post->content = 'learning from the best teacher 2';
    $post->is_admin = 1;

    $post->save();

});

/*===========
| using create method for inserting multiple column values and update 
================*/

Route::get('/create' , function(){

    Post::create(['title'=>'hello world','content' => 'this is content with create command' ,'is_admin' =>1]);

});

Route::get('/update' , function(){

    Post::where('id',2)->update(['title'=>'my life my rules','content' => 'another way to update']);

});

/*===========
| delete
================*/

Route::get('/delete' , function(){
//NOTE whenever we use find() we have to assign it to any variable so that that variable may have the valus whcih we want to affect .also delete is not static method
    $post = Post::find(2);

    $post->delete();

});

Route::get('/delete2' , function(){

    // post::destroy(3);

    post::destroy([4,5]);

    //we can also use where conditions to delete specific data

    //post::where('is_admin' ,1)->delete();

});

/*===========
| Soft delete
================*/

Route::get('/softdelete',function(){

        Post::find(6)->delete();

});

Route::get('/readsoftdelete',function(){

//normal retrieve

    // $post = post::find(1);
    // return $post;

//normal retrieve

        $post = Post::withTrashed()->where('id',6)->get();
            return $post;
    });

Route::get('/restore',function(){

    Post::withTrashed()->where('is_admin',1)->restore();
});


Route::get('/forcedelete' , function(){
    Post::withTrashed()->where('id',6)->forceDelete();

    // Post::onlyTrashed()->forceDelete();
});


/*-------------------------------
* section 11 : Eloquent relationships
-------------------------------
*/
//dont forget to add posts model inside this file with use keyword 

// use App\Post;
use App\User;

Route::get('/users/{id}/post',function($id){

  return User::find($id)->posts;//here posts is table name and it can be chained with arow to pull the column data as ommented in next line
 // User::find($id)->posts->title;
});