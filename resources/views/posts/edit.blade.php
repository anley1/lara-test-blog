@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
        <div class="form-group">
            <form class = "form-control" action="/posts" method="POST" id="post-form">
                {{csrf_field()}}
                <input type="text" name="title" label="title" placeholder="title">
                <button type="submit" name="button">Submit</button>
            </form>
        </div>
        <textarea name="body" id="article-ckeditor" label="body" form ="post-form" placeholder="body"></textarea>

@endsection