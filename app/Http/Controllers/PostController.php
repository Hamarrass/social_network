<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* DB::connection()->enableQueryLog();
         dd(DB::getQueryLOg());*/
         /*
            $posts = [Post::withCount('comments')]== bulder->orderBy('updated_at','desc')->get();
         */
        $posts = Post::withCount('comments')->get();
        //mostCommented function you will find it in  model Post
        $mostCommented = Post::mostCommented()->take(5)->get();
        $mostUsersActive=User::usersActive()->take(5)->get();
        $tab='list';
        return view('posts.index',compact('posts','tab','mostCommented','mostUsersActive'));
    }


    public function archive()
    {
        /* DB::connection()->enableQueryLog();
         dd(DB::getQueryLOg());*/
        $posts = Post::onlyTrashed('comments')->get();
        $tab='archive';
        return view(
            'posts.index'
            ,compact('posts','tab'));
    }

    public function all()
    {
        /* DB::connection()->enableQueryLog();
         dd(DB::getQueryLOg());*/
        $posts = Post::withTrashed()->withCount('comments')->get();
        $tab='all';
        return view('posts.index',compact('posts','tab'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create');
         return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {

        /*  we use bail , to stop dispaly just when it find one error
         $validatedata=$request->validate([
             'title'   =>'bail|min:4|required|max:100',
             'content' =>'required'
         ]);*/
          $data=$request->validated();
          $data['user_id'] = $request->user()->id;
          //when you want  use create that you have in elequent you have to declare  the the atributes in the model */
          $post =Post::create($data);


      $request->session()->flash('status', $post->title.'post was created');
      return redirect()->route('posts.index') ;
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::findOrFail($id);
        $this->authorize('update',$post);
       return view("posts.edit",['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $post=Post::find($id);
        $this->authorize("update",$post);
        $post->title   = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        $request->session()->flash('status',$post->title.' was updated seccefuly');
        return  redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,  $id)
    {

        $post =Post::find($id);
        $this->authorize("delete",$post);
        $post->delete();
        $request->session()->flash('status','was deleted seccefully');
        return redirect()->route('posts.index');

    }
    public function restore($id){
        $post=Post::onlyTrashed()->where('id',$id)->first();
        $this->authorize('restore', $post);
        $post->restore();
        return back();
    }

    public function forcedelete($id){

       $post=Post::onlyTrashed()->where('id',$id)->first();
       $this->authorize('forceDelete' , $post);
       $post->forceDelete();
       return back() ;
    }

}
