@extends('layouts.app')

@section('content')
    <div class="container" id="conta">
        <style>
            #conta{
                margin: 0 auto;
                text-align: center;
            }
        </style>
        <div class="jumbotron">
            <h1 class="display-4">Welcome</h1>
            <p class="lead">We are pleased you visited this forum of African brains. We are happy you make it here.</p>
            <hr class="my-2">
           <blockquote class="blockquote">
            <p> find interesting articles and stories on politics, slavery, religion and all contributing factors that are keeping Africa behind in the eyes of the world.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="/articles" role="button">Articles</a>
            </p>
           </blockquote>
        </div>
    </div>
@endsection
