@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn">Go Back</a>
    <h1>{{$post->title}}</h1>
    
    <div>
        {!! html_entity_decode($post->body) !!} 
        {{-- parse the html as well --}}
    </div>

    <hr>
    <small>Written on {{$post->created_at}}</small>
    <hr>
    <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
@endsection

