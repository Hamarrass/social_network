@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-8">
        {{-- <nav class="nav nav-tabs nav-stacked my-5">
            <a class="nav-link @if($tab== 'list') active @endif" href="/posts">List</a>
            <a class="nav-link @if($tab== 'archive') active @endif" href="/posts/archive">Archive</a>
            <a class="nav-link @if($tab== 'all') active @endif" href="/posts/all"> All</a>
        </nav> --}}
        <div class="my-3">
            <h4>{{$posts->count()}} post(s)</h4>
        </div>

            @forelse($posts  as $post)
            <p>
                @if($post->created_at->diffInHours() <1 )
                     <x-badge type="success">new</x-badge>
                   @else
                    <x-badge  type="dark">old</x-badge>
                @endif

                <h3>
                  <a href="{{route('posts.show',['post'=>$post->id])}}">
                    @if($post->trashed())
                    <del>
                      {{$post->title}}
                    </del>
                    @else
                      {{$post->title}}
                    @endif

                  </a>
                </h3>
              @if($post->comments_count)
                    <p class="badge badge-success">{{$post->comments_count}} comments</p>
              @else
                    <p class="badge badge-danger">  no comment</p>
              @endif

                <x-updated :date="$post->updated_at"  :name="$post->user->name" ></x-updated>

              @can('update' , $post)
                <a class="btn btn-warning" href="{{route('posts.edit',['post'=>$post->id])}}">
                    Edite this post
                </a>
              @endcan

              @cannot('delete', $post)
                <x-badge type="danger"> You can't delete this post !</x-badge>
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
                 <x-badge type="success">You can't delete this post !</x-badge>
            @endforelse

   </div>
    <div class="col-4">

        <x-card title="Post most Commented">
            @foreach($mostCommented as $post)
            <li class="list-group-item">
                <x-badge type="dark">{{$post->comments_count}}</x-badge>
                <a href="http://">{{$post->title}}</a>
            </li>
            @endforeach
        </x-card>


        <x-card
            title="Most Users"
            text="Most Users post writen"
            :items="collect($mostUsersActive)->pluck('name')">
        </x-card>

          <x-card
            title="Most Users Active"
            text="Most Users Active In Last Month"
            :items="collect($usersActiveInLastMonth)->pluck('name')">
        </x-card>

    </div>
</div>

@endsection
