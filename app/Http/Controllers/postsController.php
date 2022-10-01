<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
Use Illuminate\Support\Facades\Storage;
class postsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    public function index()
    {
        $posts = Post::all();
        return view('posts')->with('posts',$posts);
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:10',
            'body' => 'required',
            'cover_image' => 'image|max:1999|nullable'
        ]);
        if($request->hasFile('cover_image')) {
            $fileFullName = $request->file('cover_image')->getClientOriginalName();
            $fileName = pathinfo($fileFullName, PATHINFO_FILENAME);
            $fileExt = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $path = $request->file('cover_image')->storeAs('/public/cover_images/', $fileNameToStore);
        }
        else {
            $fileNameToStore = 'noimage.jpg';
        }
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        return redirect('/posts')->with('success', 'Post Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $posts = Post::find($id);
        return view('posts.show')->with('posts' ,$posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Post::find($id);
        if(auth()->user()->id !== $posts->user_id) {
            return redirect('/dashboard')->with('error', 'Unauthorized Access Denied');
        }
        return view('posts.edit')->with('posts', $posts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|max:1999|nullable'
        ]);
        $post = Post::find($id);
        if($request->hasFile('cover_image')) {
            $fileFullName = $request->file('cover_image')->getClientOriginalName();
            $fileName = pathinfo($fileFullName, PATHINFO_FILENAME);
            $fileExt = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $path = $request->file('cover_image')->storeAs('/public/cover_images/', $fileNameToStore);
        }
        else {
            $fileNameToStore = 'noimage.jpg';
        }
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->cover_image = $fileNameToStore;
        $post->save();
        return redirect('/posts/' . $post->id)->with('success', 'Post Edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id != $post['user_id']) {
            return redirect('/dashboard')->with('error', 'Unauthorized Access Denied');
        }
        $imageName = $post->cover_image;
        $deletePost = Post::where('id', '=', $id)->delete();
        Storage::delete('/public/cover_images/'.$imageName);
        return redirect('/posts')->with('success', 'Post Deleted');
    }
}
