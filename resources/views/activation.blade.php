@extends('layouts.app')

@section('menu')
    @parent
    <li class="nav-item"><a href="/upload" class="nav-link">Uploading</a></li>
    <li class="nav-item"><a href="/activation" class="nav-link active" aria-current="page">Activation</a></li>
    <li class="nav-item"><a href="/library" class="nav-link">Library</a></li>
@endsection

@section('content')
    <div class="container mt-5" id="upload" style="display: flex">
        <form action="{{route('checkActivation')}}" method="post" style="margin-left: 3rem; max-width: 300px">
            <h3 class="text-center mb-3">Activate WebApp to save files</h3>
            @csrf
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('fail'))
                <div class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="form-group">
                <input type="text" name="key" id="textInput" class="form-control" placeholder="Enter activation code">
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block mt-2">
                Activate
            </button>
        </form>
    </div>
@endsection