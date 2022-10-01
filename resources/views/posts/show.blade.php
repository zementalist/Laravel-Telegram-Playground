@extends('layouts.app')

@section('content')
    <h1>{{$posts->title}}</h1>
    <ul class="list-group">
        <li class="list-group-item">
            <img src="/storage/cover_images/{{$posts->cover_image}}">
            <br>
            <br>
            <h5>{{$posts->body}}</h5>
            <small>{{$posts->created_at}} by {{$posts->user->name}}</small>
        </li>
    </ul>
    @if(Auth::user()->id === $posts->user_id)
        <button class="btn btn-default"><a href="/posts/{{$posts->id}}/edit"><p>Edit</p></a></button>
        {!! Form::open(['action' => ['postsController@destroy', $posts->id], 'method' => 'delete', 'class' => 'float-right']) !!}
            {{ Form::submit('Remove', ['class' => 'btn btn-danger']) }}
        {!! Form::close() !!}
    @endif
@endsection