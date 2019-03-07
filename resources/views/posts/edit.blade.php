@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
        {{-- <div class="form-group">
            <form class = "form-control" action="/posts" method="POST" id="post-form">
                {{csrf_field()}}
                <input type="text" name="title" label="title" placeholder="title">
                <button type="submit" name="button">Submit</button>
            </form>
        </div>
        <textarea name="body" id="article-ckeditor" label="body" form ="post-form" placeholder="body"></textarea> --}}

        {!! Form::open(['action' => ['PostsController@update',$post->id], 'method' => 'POST']) !!}
        {{csrf_field()}}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $post->title, ['class'=> 'form-control', 'placeholder'=>'Title'])}}
        </div>
        <div class="form-group">
                {{Form::label('body', 'Body')}}
                {{Form::textarea('body', $post->body, ['id'=> 'article-ckeditor', 'class'=> 'form-control', 'placeholder'=>'Title'])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}

@endsection