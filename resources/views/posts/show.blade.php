
@extends('layout')
@section('content')




        <h2>{{$post->title}}      </h2>
        <p>{{$post->content}}     </p>
        <em>{{$post->created_at->diffForHumans()}} </em>
        <p>{{$post->active}}</p>





@endsection
