@extends('layouts.app')

@section('menu')
    @parent
    <li class="nav-item"><a href="#" class="nav-link">Uploading</a></li>
    <li class="nav-item"><a href="#" class="nav-link">Activation</a></li>
    <li class="nav-item"><a href="#" class="nav-link">Library</a></li>
@endsection

@section('content')
    <div class="container mt-5" style="max-width: 330px">
        <form action="{{route('captchaCheck')}}" method="post">
            <h3 class="text-center mb-3">Captcha</h3>
            @csrf
            @if ($message = Session::get('fail'))
                <div class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="g-recaptcha" data-sitekey="6LdwgFAgAAAAALEAGgS-ogsWWPa5TC0wiamjxjn2" style="display: flex; justify-content: center;"></div>
            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">Submit</button>
        </form>
    </div>

@endsection