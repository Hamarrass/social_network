
@extends('layouts.app')

@section('content')


<h1>List of posts</h1>

<ul class="list-group">
    @forelse($posts  as $post)
    <li class="list-group-item">
        <a href="{{route('posts.show',['post'=>$post->id])}}">{{$post->title}}   </a>
        <p>{{$post->content}}     </p>
        <em>{{$post->created_at}} </em>
      @if($post->comment_count)
        <div>
              <span class="badge badge-success">{{$post->comment_count}} comments</span>
        </div>
      @else
        <div>
            <span class="badge badge-danger">  no comment</span>
      </div>
      @endif

        <em> <a class="btn btn-warning" href="{{route('posts.edit',['post'=>$post->id])}}">Edite this post</a></em>
        <em>
            <form  style="display:inline" action="{{route('posts.destroy',['post'=>$post->id])}}" method="POST">
               @csrf
                @method('DELETE')
              <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </em>
    </li>
    @empty

    <span class="badge badge-danger">posts is empty </span>
    @endforelse


</ul>



@endsection
