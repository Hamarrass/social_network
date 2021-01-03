<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
       $data=$request->only(['title','content']);
       $data['slug']=Str::slug($data['title'],'-');
       $data['active']=true;
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

        $post =Post::destroy($id);

        $request->session()->flash('status','was deleted seccefully');
        return redirect()->route('posts.index');

    }
}
