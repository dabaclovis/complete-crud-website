@extends('layouts.app')

@section('content')
    <a href="/articles" class="btn btn-secondary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>
    </a>
    <div class="container">
        @if ($article->image == 'noimage.jpg')
            <div class="card">
              <div class="card-body">
                  <h4 class="card-title">{{ $article->title }}</h4>
                <blockquote class="blockquote">
                  <p>{{ $article->body }}</p>
                  <footer class="card-blockquote">
                    @if (!Auth::guest())
                        @if (Auth::user()->id != $article->user->id)
                         <a href="/articles/{{ $article->id }}/edit" class="btn btn-secondary">
                            <i class="fa fa-edit fa-md"></i>
                        </a>
                            {!! Form::open(['action' => ['App\Http\Controllers\ArticlesController@destroy',$article->id],
                            'method' => 'POST','enctype' => 'multipart/form-date','class' =>'pull-right']) !!}
                                {!! Form::hidden('_method', 'DELETE') !!}
                                {{ Form::submit('Delete',['class' => 'btn btn-danger']) }}
                            {!! Form::close() !!}
                    @endif
                @endif
                </footer><hr>
                <small> Creator {{ $article->user->name }}</small>
                </blockquote>
              </div>
            </div>

    @else
    <div class="card">
        <div class="card-header">
            <img src="{{ asset('/storage/articles/'.$article->image) }}" width="100%" height="500px;" alt="">
        </div>
        <div class="card">
          <div class="card-body">
              <h4 class="card-title">{{ $article->title }}</h4>
            <blockquote class="blockquote">
              <p>{{ $article->body }}</p>
              <footer class="card-blockquote">
                @if (!Auth::guest())
                    @if (Auth::user()->id == $article->user->id)
                         <a href="/articles/{{ $article->id }}/edit" class="btn btn-secondary">
                            <i class="fa fa-edit fa-md"></i>
                        </a>
                            {!! Form::open(['action' => ['App\Http\Controllers\ArticlesController@destroy',$article->id],
                            'method' => 'POST','enctype' => 'multipart/form-date','class' =>'pull-right']) !!}
                                {!! Form::hidden('_method', 'DELETE') !!}
                                {{ Form::submit('Delete',['class' => 'btn btn-danger']) }}
                            {!! Form::close() !!}
                    @endif
                @endif
              </footer><hr>
              <small> Creator {{ $article->user->name }}</small>
            </blockquote>
          </div>
        </div>
    </div>
    @endif
    </div>
@endsection
