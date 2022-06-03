@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger"> {{ $error }} </div>
                @endforeach
            @endif
            <div class="card">

                <form action="/" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" required>
                            <label for="file" class="custom-file-label">Choose File</label>
                        </div>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-success btn-outline-dark">Upload</button>
                        </div>
                    </div>

                </form>

                <div class="card-body">
                    @if (session('status'))
                        @if(session('status') == "Post was uploaded successfully.")
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(session('status') == "Post was deleted successfully.")
                            <div class="alert alert-danger"> {{ session('status')}} </div>
                        @endif
                    @endif

                    <div class="row">
                        @foreach($galleries as $gallery)
                        <div class="card col-md-2">
                            <div class="card-body p-0">
                                <img src="{{ asset('upload/' . $gallery->name) }}" alt="" class="img-fluid" style="width:100%;height:350px;">
                            </div>
                            <div class="card-footer">
                                <a href="{{ asset('upload/' . $gallery->name)}}" target="_blank" class="btn btn-info">View</a>
                                <a href="{{ route('home.download', $gallery->id) }}" class="btn btn-success">Download</a>
                                <a href="{{ route('home.destory', $gallery->id) }}" class="btn btn-danger float-right">Delete</a>
                            </div>
                        </div>
                        @endforeach

                    
                </div>
            </div>
        </div>
    </div>    
    </div>

</div>
@endsection
