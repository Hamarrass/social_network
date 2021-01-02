@extends('layout')
@section('content')


<form action="{{route('posts.store')}}" method="POST">
@csrf
    <div>
        <label for="">Your title</label>
        <input  name="title" id="title" type="text">
    </div>

    <div>
        <label for="content">Your content</label>
        <input name="content" id="content" type="text">
    </div>
    <button type="submit"> Add post</button>
</form>


@endsection
