@extends('artadmin::auth_page')
@section('title', 'Создание')

@section('content')
    <div class="main_content_iner">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("admin.boards.index") }}">Доски</a></li>
                <li class="breadcrumb-item active" aria-current="page">Создание</li>
            </ol>
        </nav>



    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="dzenkit-basic-card dzenkit-fulltable-maxwid-lg">
            <div class="dzenkit-table-header hdr-box d-flex align-items-center justify-content-between">
                <div class="hdr">Создание</div>
            </div>
            <div class="dzenkit-selections-setting" style="display: block;">
                <div class="dzenkit-basic-card-body">
    <form action="javascript:void(0);" class="crud_form" data-action="{{ route('admin.boards.store') }}" method="POST" enctype="multipart/form-data">
        @csrf


        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 mb-2 mt-2 row">
                <div class="col-4">
                    <strong>Название доски:</strong>
                </div>
                <div class="col-7">

                    <input type="text" name="title" value="" data-title="Название доски" class="crud_field_title form-control"  placeholder="Название доски">
                </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 mb-2 mt-2 row">
                <div class="col-4">
                    <strong>alias:</strong>
                </div>
                <div class="col-7">

                    <input type="text" name="alias" value="" data-title="alias" class="crud_field_alias form-control"  placeholder="alias">
                </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 mb-2 mt-2 row">
                <div class="col-4">
                    <strong>Описание:</strong>
                </div>
                <div class="col-7">

                    <textarea name="description"  data-title="Описание" class="crud_field_description tiny form-control"  placeholder="Описание"></textarea>
                </div>
</div>




            <div class="crud_notify alert alert-danger" style="display:none">

            </div>
            <div class="row col-xs-12 col-sm-12 col-md-12 text-center">
                <div class="col-5">
                    <button type="submit" name="redirect" value="list" class="btn_create_list btn btn-primary">Создать и перейти в список</button>
                </div>
                <div class="col-5">
                    <button type="submit" name="redirect" value="edit" class="btn_create_edit btn btn-primary">Создать и перейти в редактирование</button>

                </div>

            </div>
        </div>

    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_js')
    <script src="{{ asset("vendor/artcrud/crud.js") }}"></script>
@endsection
