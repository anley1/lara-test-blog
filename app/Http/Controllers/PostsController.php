<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // The below line is using Eloquent
        //$posts = Post::all(); //get all posts in the database
        //$posts = Post::orderBy('title', 'desc')->get(); // descending order
        $posts = Post::orderBy('created_at', 'desc')->paginate(4); // descending order paginated 2 per page
        //$post = Post::where('title', 'Post One')->get(); // get first post by title for example
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                       // do stuff with the data here
    $this->validate($request, [
        'title' => 'required',
        'body' => 'required',
        'cover_image' => 'image|nullable|max:1999'
        // 1999 is just below 2MB max for apache server for example
    ]);

    // Handle a file upload
    if($request->hasFile('cover_image'))
    {
        $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        //Get just extension
        $extension = $request->file('cover_image')->getClientOriginalExtension();

        // Store filename
        $fileNameToStore = $filename.'_'.time().'.'.$extension;

        // Upload image
        $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

    }
    else
    {
        $fileNameToStore = 'noimage.jpg';
    }

       // Create post
       $post = new Post;
       $post->title = $request->input('title');
       $post->body = $request->input('body');
       $post->user_id = auth()->user()->id;
       $post->cover_image = $fileNameToStore;
       $post->save();

       // Go back to index page
        return redirect('/posts')->with('success','Post Created');
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
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);
        // Check if the user is the CORRECT user
        if(auth()->user()->id !==$post->user_id)
        {
            return redirect('/posts')->with('error', 'Unauthorised page');
        }

        return view('posts.edit')->with('post', $post);
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
        //
                // do stuff with the data here
    $this->validate($request, [
        'title' => 'required',
        'body' => 'required',
        'cover_image' => 'image|nullable|max:1999'
        // 1999 is just below 2MB max for apache server for example
    ]);

    // Handle a file upload
    if($request->hasFile('cover_image'))
    {
        $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        //Get just extension
        $extension = $request->file('cover_image')->getClientOriginalExtension();

        // Store filename
        $fileNameToStore = $filename.'_'.time().'.'.$extension;

        // Upload image
        $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

    }
    else
    {
        $fileNameToStore = 'noimage.jpg';
    }

    // Create post
    $post = Post::find($id);
    $post->title = $request->input('title');
    $post->body = $request->input('body');
    $post->user_id = auth()->user()->id;
    $post->cover_image = $fileNameToStore;
    $post->save();

    // Go back to index page
     return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        // Check if the user is the CORRECT user
        if(auth()->user()->id !==$post->user_id)
        {
            return redirect('/posts')->with('error', 'Unauthorised page');
        }
        
        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted');
    }
}
