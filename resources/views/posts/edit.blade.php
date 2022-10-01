@extends('layouts.app')

@section('content')
    <h2>Edit Post</h2>
    {!! Form::open(['action' => ['postsController@update', $posts->id], 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}
    {{ Form::label('title', 'Title') }}
    {{ Form::text('title', $posts->title, ['class' => 'form-control', 'placeholder' => 'Title']) }}
    {{ Form::label('body', 'Body') }}
    {{ Form::textarea('body', $posts->body, ['class' => 'form-control', 'placeholder' => 'Body']) }}
    {{ Form::label('cover_image', 'Image:') }}
    {{ Form::file('cover_image') }}
    <br>
    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection