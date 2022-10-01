@extends('layouts.app')

@section("content")
    <a href="\"><input type="button" class="btn btn-success" value="Back"></a>
    <h1>Laravel Course</h1>
    <p>Here we are learning:</p>
    <ul>
        @foreach($details as $detail)
        <li class="list-item">{{$detail}}</li>
        @endforeach
    </ul>
@endsection
