@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
            <hr>
            <div class="card">
                    <div class="card-header">Your Posts</div>

                    <div class="card-body">
                        @if( count($posts) > 0 )
                            <table class="table table-striped">
                                <tr>
                                    <th>Title</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>
                                            <h4><a href="/posts/{{$post->id}}">{{$post->title}}</a></h4>
                                        </td>
                                        <td>
                                            <a href="/posts/{{$post->id}}/edit" class="btn btn-secondary" >Edit</a>
                                        </td>
                                        <td>
                                                {!! Form::open(['action' => ['postsController@destroy', $post->id], 'method' => 'delete']) !!}
                                                    {{ Form::submit('Remove', ['class' => 'btn btn-danger']) }}
                                                {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p>You have no posts.</p>
                        @endif
                    </div>
            </div>

        </div>
    </div>
</div>
@endsection
