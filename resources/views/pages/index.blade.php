@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3">Welcome to Laravel!</h1>
        <p>This is the laravel application index page</p>
        <p><a class="btn btn-primary btn-lg" href="public/register" role="button">Register</a> <a class="btn btn-success btn-lg" href="/login" role="button">Login</a></p>
    </div>
</div>
@endsection