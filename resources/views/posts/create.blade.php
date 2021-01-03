@extends('layout')
@section('content')

<!-- give you how man word do you want so  us this lorem(2or10)-->
<h1>New post</h1>
<form action="{{route('posts.store')}}" method="POST">

    @csrf
    @include('posts.form')

    <button class="btn btn-block btn-primary" type="submit"> Add post</button>
</form>


@endsection
