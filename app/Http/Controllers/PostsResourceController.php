<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {echo "you are in controller index function  ";
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        echo "passing data into create <br>";
        echo " your data is $id";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return "you are in show method  mr. iqbal .your roll no. is $id";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function contact(){

        return view('contact');

    }

    public function show_post($id,$name){

        // return view('posts')->with('id',$id)->with('name',$name);

        return view('posts',compact('id','name'));
    }

    public function roll_no(){
//here we are passing an array in view 
//in this view we have used the foreach loop with blade template .check it out
        $students = ['iqbal' , 'amrit' ,'vishal' , ' kartik'];
        return view('layouts.rollno', compact('students'));
    }

    public function class($id){

        return view('layouts.class',compact('id'));
    }
}

