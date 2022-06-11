@extends('layouts.app')

@section('menu')
    @parent
    <li class="nav-item"><a href="/upload" class="nav-link active" aria-current="page">Uploading</a></li>
    <li class="nav-item"><a href="/activation" class="nav-link">Activation</a></li>
    <li class="nav-item"><a href="/library" class="nav-link">Library</a></li>
@endsection

@section('content')
    <div class="container mt-5" id="upload" style="display: flex">
        <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
            <h3 class="text-center mb-5">Uploading File</h3>
            @csrf
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                <label class="custom-file-label" for="chooseFile">Select file</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Upload File
            </button>
        </form>
    </div>
@endsection















{{--<section>--}}
{{--    <h3 class="center error">You can't upload files more than 100kb!</h3>--}}
{{--    <p class="center">If you want to upload files upper than 100mb enter key:</p>--}}
{{--    <form class=" block-width ml margin-top" action="controllers/checkCode.php" method="post">--}}
{{--        <div class="input-group center">--}}
{{--            <input type="text" name="code" class="form-control" placeholder="Enter code" aria-label="Code" aria-describedby="basic-addon2">--}}
{{--            <input class="btn btn-outline-secondary" name="send" type="submit" id="inputGroupFileAddon84" value="Check" />--}}
{{--        </div>--}}
{{--        <div class="g-recaptcha"--}}
{{--             data-sitekey="6LdwgFAgAAAAALEAGgS-ogsWWPa5TC0wiamjxjn2"></div>--}}
{{--    </form>--}}
{{--    <form class="block-width ml margin-top" action="go.php" method="post" enctype="multipart/form-data">--}}
{{--        <!-- форма будет отправлять введенные пользователем данные скрипту gо.php методом POST -->--}}
{{--        <img src='captcha.php' id='capcha-image'>--}}
{{--        <!-- Сама капча -->--}}
{{--        <a href="javascript:void(0);" onclick="document.getElementById('capcha-image').src='captcha.php?rid=' + Math.random();">06новить капчу</a>--}}
{{--        <!-- Ссылка на обновление капчи. Запрашиваем у captcha.php случайное изображение. -->--}}
{{--        <span>Введите капчу:</span>--}}
{{--        <input type="text" name="code">--}}
{{--        <input type="submit" name="go" value="Продолжитb">--}}
{{--        <!-- Отправляем данные скрипту-обработчику go.php -->--}}
{{--    </form>--}}
{{--</section>--}}