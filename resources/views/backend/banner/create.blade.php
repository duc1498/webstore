
@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Thêm Banner
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">General Elements</li>
        </ol>
    </section>
    <section class="content-header">
        {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif --}}
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm mới Banner</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('admin.banner.store')}}" enctype="multipart/form-data" id="form">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tiêu đề</label>
                                <input id="title" name="title" type="text" class="form-control" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Chọn ảnh</label>
                                <input type="file" name="image" id="image">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Liên kết</label>
                                <input type="text" class="form-control" id="url" name="url" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Chọn Target</label>
                                <select class="form-control" name="target" id="target">
                                    <option></option>
                                    @foreach (config('banner.target') as $key => $target)
                                        <option value="{{$key}}">{{$target}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại</label>
                                <select class="form-control" name="type" id="type">
                                <option></option>
                                @foreach (config('banner.type') as $key => $type)
                                    <option value="{{$key}}">{{$type}}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Vị trí</label>
                                <input min="0" type="number" class="form-control" id="position" name="position" placeholder="">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input value="1" type="checkbox" name="is_active" id="is_active"> Trạng thái
                                </label>
                            </div>

                            <div class="form-group">
                                <label id="is_description">Mô tả</label>
                                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btnCreate">Thêm</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection


@section('js')
    {{-- <script type = "text/javascript">
        $( document ).ready(function() {
            $('.btnCreate').click(function () {
                var error_mess = {};
                var att = ['title', 'url','position','is_active'];
                var vi = [];
                vi['title'] = 'tieu de';
                vi['url'] = 'ảnh';
                vi['position'] = 'Vị trí';
                vi['is_active'] = 'trạng thá1'
                $.each(att, function(index, val) {
                    if ($('#' + val).val() === '') {
                        error_mess[val] = 'ban chua nhap ' + vi[val]
                    }
                });
                $.each(error_mess, function(name, message) {
                    $(`#${name}`).notify(`${message}`,'error');
                    document.getElementById(`${name}`).scrollIntoView();
                });
            });
            if(empty(error_mess)) {$('#form').submit();}
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            CKEDITOR.replace( 'description' );

            $('.btnCreate').click(function() {
                if ($('#title').val() === '') {
                    $('#title').notify('ban chua nhap tieu de','error');
                    document.getElementById('title').scrollIntoView();
                    return false;
                }
            });

        });
    </script>
@endsection
