@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-content-center">
            <div class="col-sm-10 col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color:lightgray">
                       <h4 style="text-align: center; ">Create Article</h4>
                    </div>
                    <div class="card-body">
                        <blockquote>
                            {!! Form::open(['action' => 'App\Http\Controllers\ArticlesController@store','method' =>'POST','enctype' => 'multipart/form-data']) !!}
                                <div class="form-group">
                                    {!! Form::label('title','Title') !!}
                                    {!! Form::text('title', '', ['class' =>'form-control']) !!}
                                   @error('title')
                                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    {{ $message }}
                                </div>
                                   @enderror
                                </div>
                                <div class="form-group">
                                    {!! Form::label('body','Content') !!}
                                    {!! Form::textarea('body', '', ['class' =>'form-control']) !!}
                                   @error('body')
                                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    {{ $message }}
                                </div>
                                   @enderror
                                </div>
                                <div class="form-group">
                                    {!! Form::file('image') !!}
                                </div>
                                <div class="form-group">
                                   {!! Form::submit('Submit', ['class' => 'btn btn-secondary']) !!}
                                </div>
                            {!! Form::close() !!}
                        </blockquote>
                    </div>
                    <div class="card-footer text-muted" style="background-color: lightgray;">
                        &copy; <?php echo date('l, Y') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
