@extends('artadmin::auth_page')
@section('title', 'Тред')
@section('content')
    <div class="main_content_iner">
        <!-- InstanceBeginEditable name="workspace" -->

        <!--<div class="breadcrumbs">
            <p>
                <a href="index.html">Сфера-СМ</a>
                <i class="icon-angle-right"></i>
                <a href="cat--diagnostika.html">Диагностика</a>
                <i class="icon-angle-right"></i>
                <span>МРТ обследование</span>
            </p>
        </div>-->







        <div class="dzenkit-basic-card dzenkit-fulltable-maxwid-lg">

            <div class="dzenkit-table-header hdr-box d-flex align-items-center justify-content-between">
                <div class="hdr">Тред #{{ $rows[0]->getId() }} на доске {{ $board->getTitle() }} </div>

            </div>

            <!-- ++++++++++ dzenkit-selections-setting ++++++++++ -->

            <!-- ++++++++++ / dzenkit-selections-setting ++++++++++ -->



            <div class="dzenkit-basic-card-body rows_super_list">
                @if(count($rows)>0)
                    @foreach($rows as $row)
                        <div class="col-12 mb-2 mt-2">
                            @include("admin.threads.message_full",["board"=>$board,"thread"=>$row])
                        </div>
                    @endforeach
                @endif

            </div>
        </div>












        <!-- ==================== M O D A L S ==================== -->

        <!-- ==================== / M O D A L S ==================== -->



        <!-- InstanceEndEditable -->
    </div>
@endsection
@section('footer_js')
    <script src="{{ asset("vendor/artcrud/crud.js") }}"></script>
@endsection
