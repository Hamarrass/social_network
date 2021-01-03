@extends('layout')
@section('content')

<!-- give you how man word do you want so  us this lorem(2or10)-->

<form action="{{route('posts.store')}}" method="POST">

    @csrf
    @include('posts.form')

    <button type="submit"> Add post</button>
</form>


@endsection
