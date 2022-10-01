@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    <ul class="list-group">
        @foreach($posts as $post)
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                    <img src="/storage/cover_images/{{$post->cover_image}}" style="width:100%;border:0.5px solid black;">
                    </div>
                    <div class="col-md-8">
                        <li class="list-group-item" style="top:5.5rem;border:none;">
                            <a href="posts/{{$post->id}}"><h3>{{$post->title}}</h3></a>
                            <small>By {{$post->user->name}}</small>
                        </li>
                    </div>
                </div>
            </div>
        </div>
            <br>
        @endforeach
    </ul>
@endsection