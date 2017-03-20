@extends('ap')


@section('content')

@if($first == 'John')
    {{--<h1>About Me: {{ $name }}</h1>--}}
    <h1>Hi John</h1>
@else
    <h1>Else</h1>
@endif


    <h1>About Me {{ $first }}</h1>

    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. A amet deleniti doloremque eum ex explicabo illum in temporibus. Animi aspernatur consequatur corporis dignissimos eveniet fuga illo iste praesentium tempora tempore.
    </p>
@stop