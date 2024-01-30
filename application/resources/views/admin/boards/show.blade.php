@extends('artadmin::auth_page')
@section('title', 'Просмотр')
@section('content')
    <div class="main_content_iner">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("admin.boards.index") }}">Доски</a></li>
                <li class="breadcrumb-item active" aria-current="page">Просмотр</li>
            </ol>
        </nav>

    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Название доски:</strong>{{ $boards->title }}

            </div>
        </div>
<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>alias:</strong>{{ $boards->alias }}

            </div>
        </div>
<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Описание:</strong>{{ $boards->description }}

            </div>
        </div>


    </div>
    </div>
@endsection
