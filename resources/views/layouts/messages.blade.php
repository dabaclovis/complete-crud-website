@if (count($errors)>0)
    @foreach ($errors->all()  as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            {{$error}}
        </div>
        {{-- <div class="alert alert-danger" role="alert">
            {{$error}}
        </div> --}}
    @endforeach
@endif

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        {{session('success')}}
    </div>
    {{-- <div class="alert alert-success" role="alert">
        {{session('success')}}
    </div> --}}
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        {{session('error')}}
    </div>
    {{-- <div class="alert alert-success" role="alert">
        {{session('error')}}
    </div> --}}
@endif
