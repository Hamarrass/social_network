
@extends('layout')
@section('content')


<h1>List of posts</h1>

<ul>
    @forelse($posts  as $post)
    <li>
        <a href="{{route('posts.show',['post'=>$post->id])}}">{{$post->title}}   </a>
        <p>{{$post->content}}     </p>
        <em>{{$post->created_at}} </em>
        <em> <a href="{{route('posts.edit',['post'=>$post->id])}}">Edite this post</a></em>
        <em>
            <form action="{{route('posts.destroy',['post'=>$post->id])}}" method="POST">
               @csrf
                @method('DELETE')
              <button type="submit">Delete</button>
            </form>
        </em>
    </li>
    @empty

    <li>posts is empty </li>
    @endforelse


</ul>



@endsection
