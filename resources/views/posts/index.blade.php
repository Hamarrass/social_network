
@extends('layouts.app')

@section('content')

<nav class="nav nav-tabs nav-stacked my-5">
    <a class="nav-link @if($tab== 'list') active @endif" href="/posts">List</a>
    <a class="nav-link @if($tab== 'archive') active @endif" href="/posts/archive">Archive</a>
    <a class="nav-link @if($tab== 'all') active @endif" href="/posts/all"> All</a>
</nav>
<div class="my-3">
    <h4>{{$posts->count()}} post(s)</h4>
</div>
    @forelse($posts  as $post)
    <p>
        <h3>
          <a href="{{route('posts.show',['post'=>$post->id])}}">{{$post->title}}   </a>
        </h3>
      @if($post->comments_count)

            <p class="badge badge-success">{{$post->comments_count}} comments</p>

      @else

            <p class="badge badge-danger">  no comment</p>

      @endif
      <p>
        <div class='text-muted'>
          {{$post->updated_at->diffForHumans()}} by {{$post->user->name}}
        </div>
      </p>

      @can('update' , $post)
        <a class="btn btn-warning" href="{{route('posts.edit',['post'=>$post->id])}}">
            Edite this post
        </a>
      @endcan

      @cannot('delete', $post)
          <span class="badge badge-danger">You can't delete this post !</span>
      @endcannot
        @if(!$post->deleted_at)
        @can('delete',$post )
          <form  style="display:inline" action="{{route('posts.destroy',['post'=>$post->id])}}" method="POST">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        @endcan
       @else
       @can('restore', $post)
          <form  style="display:inline" action="{{URL('/posts/'.$post->id.'/restore')}}" method="POST">
            @csrf
            @method('PATCH')
            <button class="btn btn-success" type="submit">Restor</button>
          </form>
        @endcan

        @can('forceDelete', $post)
          <form  style="display:inline" action="{{URL('/posts/'.$post->id.'/forcedelete')}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">force delete</button>
          </form>
        @endcan
       @endif
    </p>
    @empty

    <span class="badge badge-danger">posts is empty </span>
    @endforelse






@endsection
