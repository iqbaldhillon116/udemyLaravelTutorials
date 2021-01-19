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

