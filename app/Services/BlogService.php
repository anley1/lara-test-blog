<?php

namespace LaraTest\Services;

use LaraTest\Http\Requests\BlogPostRequests;
use LaraTest\Post;
use Illuminate\Support\Facades\Storage;

class BlogService
{

    public function savePost(BlogPostRequests $request)
    {
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
            $fileNameToStore = 'no_image.jpg';
        }

        // Create post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

    }

    public function updatePost(BlogPostRequests $request,$id)
    {
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

        // Create post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore; // only change if the user changes it
        }
        $post->save();

    }

    public function checkPost($post)
    {
        // Abort if the post is not valid

        if ($post == null)
        {
            abort(404);
        }
    }
}