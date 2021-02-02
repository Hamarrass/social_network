
@extends('layouts.app')

@section('content')


        <h2>{{$post->title}}      </h2>
        <p>{{$post->content}}     </p>
        <em>{{$post->created_at->diffForHumans()}} </em>

        @foreach ($post->comments as $comment)
         <p>{{$comment->content}}</p>
         <p>{{$comment->created_at}}</p>
         <br>
        @endforeach






@endsection
