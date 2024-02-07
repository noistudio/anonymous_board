<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>@yield('meta_title')</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>
<body class="" data-main-message-url="{{ env('APP_URL') }}/message" data-ajax-message-url="{{ env('APP_URL') }}/ajax/message">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('site.index') }}">{{ env('APP_LOGO') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route("site.index") }}">Доски</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn_favorite_modal" href="javascript:void(0);"  >Избранное</a>
                </li>

            </ul>
            <form class="d-flex" method="GET">
                <input class="form-control me-2" type="search" value="{{ $search_value }}" name="search" placeholder="Введите" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Найти</button>
            </form>
        </div>
    </div>
</nav>
<main class="">
@if(\Illuminate\Support\Facades\Session::has("error"))
    <div class="alert alert-danger">
        <p>{{ \Illuminate\Support\Facades\Session::get("error") }}</p>
    </div>
@endif

@if(\Illuminate\Support\Facades\Session::has("success"))
    <div class="alert alert-success">
        <p>{{ \Illuminate\Support\Facades\Session::get("success") }}</p>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@section('content')

@show
@include("web.components.modal")
</main>
<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
            <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
        </a>
        <span class="mb-3 mb-md-0 text-muted">© 2024 Anonymous Board</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
        <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
        <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
    </ul>
</footer>

@section("fixed_bottom")

@show

<script src="{{ asset('js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('js/jquery-3-5-1.js') }}"></script>
@include("web.scripts.btns")
@section('footer_js')
@show

<link href="{{ asset('css/footer.css') }}" rel="stylesheet">
</body>
</html>
