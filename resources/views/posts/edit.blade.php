@extends('layout')
@section('content')

<!-- give you how man word do you want so  us this lorem(2or10)-->

<form action="{{route('posts.update',['post'=>$post->id])}}" method="POST">
     @csrf
     @method('PUT')
     @include('posts.form')

    <button type="submit"> update post</button>
</form>


@endsection
