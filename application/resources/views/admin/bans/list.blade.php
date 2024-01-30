@extends('artadmin::auth_page')
@section('title', 'Треды')
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
                <div class="hdr">Треды</div>

            </div>

            <!-- ++++++++++ dzenkit-selections-setting ++++++++++ -->

            <!-- ++++++++++ / dzenkit-selections-setting ++++++++++ -->



            <div class="dzenkit-basic-card-body rows_super_list">
                <div class="dzenkit-basic-card-body">
                    <p class="hdr">Настройка выборки</p>

                    <form action="">




                        <!-- / form SELECT GROUP with CHAIN of selects -->



                        <div class="row mb-3">
                            <label for="selectForm_CategorSubGroup" class="col-md-4 col-form-label">IP</label>
                            <div class="col-md-4">
                               <input type="text" name="ip" value="{{ $ip }}" class="form-control">
                            </div>
                        </div>













                        <div class="row dzenkit-submit-box">
                            <div class="offset-md-4">
                                <button type="submit" class="btn btn-info">Найти</button>
                            </div>
                        </div>



                    </form>
                </div>



                @if(count($bans)>0)
                    @foreach($bans as $ban)
                    <div class="row card">
                        <p>ХЕШ:{{ $ban->getHash() }}</p>
                        <p>Доска:{{ $ban->getBoardId() }}</p>
                        <p>Заблокирован до:{{ $ban->getDateTo() }}</p>
                        <p><a href="{{ route('admin.bans.remove',$ban->getId()) }}">Снять блокировку</a></p>
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
