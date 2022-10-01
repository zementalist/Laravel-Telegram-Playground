@extends('layouts.app')

@section('content')
    <div>
    {!! Form::open(['method' => 'get', 'enctype' => 'multipart/form-data', 'onsubmit' => 'function(event){event.preventDefault();}']) !!}
    {{ Form::label('test', 'Field:') }}
    {{ Form::text('test', '', ['class' => 'form-control', 'id' => 'data']) }}
    {{ Form::submit('Submit', ['class' => 'btn btn-primary', 'id'=>'idtest']) }}
    {!! Form::close() !!}
    </div>
    @if(isset($str))
    <h5>{{$str}}</h5>
    @endif
    <h6 id="result"></h6>
    <script>
        function show() {
            document.getElementById('myframe').focus();
            console.log(document.getElementById('myframe').document.getElementById('testaa'));
        }
        function run() {
            setTimeout(show, 2000);
        }
        document.getElementById('idtest').addEventListener('click', (event) => {
  event.preventDefault();
});
    </script>
@endsection