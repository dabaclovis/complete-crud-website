@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        {{session('success')}}
    </div>
@endif
    <div class="container">
        <a href="/articles/create" class="pull-right">Articles</a>
        <hr>
        <section>
           @if (count($articles) > 0)
                @foreach ($articles as $article)
                    @if ($article->image == 'noimage.jpg')
                        <div class="card">
                          <div class="card-body">
                              <h4 class="card-title">{{ $article->title }}</h4>
                            <blockquote class="blockquote">
                              <p>{{ $article->body }} <a href="/articles/{{ $article->id }}"> ...see detail</a></p>
                              <footer class="card-blockquote">
                                <small>created by {{ $article->user->name }}</small><br>
                                <small>{{ $article->created_at }}</small>
                            </footer>
                            </blockquote>
                          </div>
                        </div>
                    @else
                        <div class="card">
                          <div class="card-body">
                              <h4 class="card-title">{{ $article->title }}</h4>
                            <blockquote class="blockquote">
                              <p>{{ $article->body }} <a href="/articles/{{ $article->id }}"> ...see detail</a></p>
                            <footer class="card-blockquote">
                                <small>created by {{ $article->user->name }}</small><br>
                                <small>{{ $article->created_at }}</small>
                            </footer>
                            </blockquote>
                          </div>
                        </div>
                    @endif
                @endforeach
                {{ $articles->links() }}
           @endif
        </section>
    </div>
@endsection
