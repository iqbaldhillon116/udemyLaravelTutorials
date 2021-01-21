@extends('layouts.app')

@section('content')
 <h1>rollno is 11</h1>
    @if(count($students))
    <ul>
            @foreach($students as $key)
                    <li>{{$key}}</li>
            @endforeach
    </ul>
    @endif
@stop