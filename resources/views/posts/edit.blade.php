@extends('layouts.app')

@section('content')

<!-- give you how man word do you want so  us this lorem(2or10)-->
<h1>Edit post</h1>
<form action="{{route('posts.update',['post'=>$post->id])}}" method="POST">
     @csrf
     @method('PUT')
     @include('posts.form')

    <button class="btn btn-block btn-warning" type="submit"> update post</button>
</form>


@endsection
