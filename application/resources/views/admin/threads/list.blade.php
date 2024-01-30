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
                            <label for="selectForm_CategorSubGroup" class="col-md-4 col-form-label">Доска</label>
                            <div class="col-md-4">
                                <select class="form-select" name="board_alias"  >
                                    @if(count($boards))
                                        @foreach($boards as $board)
                                            <option @if($current_board->getAlias()==$board->getAlias()) selected @endif value="{{ $board->getAlias() }}">{{ $board->getTitle() }}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                        </div>













                        <div class="row dzenkit-submit-box">
                            <div class="offset-md-4">
                                <button type="submit" class="btn btn-info">Найти</button>
                            </div>
                        </div>



                    </form>
                </div>

                @if(count($threads)>0)
                    @foreach($threads as $thread)
                        <div class="col-12 mb-2 mt-2">
                            @include("admin.threads.message_first",["board"=>$current_board,"thread"=>$thread])
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
