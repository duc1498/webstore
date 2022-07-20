
@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Thêm Aticle
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
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('admin.article.store')}}" enctype="multipart/form-data" id="form">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input id="title" name="title" type="text" class="form-control" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Chọn ảnh</label>
                                <input type="file" name="image" id="image">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">slug</label>
                                <input id="slug" name="slug" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">summary</label>
                                <input id="summary" name="summary" type="text" class="form-control" placeholder="">
                            </div>

                            <div class="form-group">
                                <label id="is_description">Mô tả</label>
                                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter ..."></textarea>
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
                                    <input value="1" type="checkbox" name="is_active" id="is_active"> hiển thị </label>
                            </div>

                            <div class="form-group">
                                <label id="is_description">Mô tả</label>
                                <textarea id="meta_description" name="meta_description" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Meta_title</label>
                                <input id="meta_title" name="meta_title" type="text" class="form-control" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option></option>
                                    @foreach ($category as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
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

    <script type="text/javascript">
        $( document ).ready(function() {
            CKEDITOR.replace( 'summary' );
            CKEDITOR.replace( 'description' );
            $('.btnCreate').click(function () {
                if ($('#title').val() === '') {
                    $('#title').notify('Bạn nhập chưa nhập tiêu đề','error');
                    document.getElementById('title').scrollIntoView();
                    return false;
                }
                if ($('#category_id').val() === 0 || $('#category_id').val() === '') {
                    $('#category_id').notify('Bạn chưa chọn danh mục','error');
                    document.getElementById('category_id').scrollIntoView();
                    return false;
                }
                var summary = CKEDITOR.instances["summary"].getData();
                if (summary === '') {
                    $('#label-summary').notify('Bạn nhập chưa nhập tóm tắt','error');
                    document.getElementById('label-summary').scrollIntoView();
                    return false;
                }
                var description = CKEDITOR.instances["description"].getData();
                if (description === '') {
                    $('#label-description').notify('Bạn nhập chưa nhập mô tả','error');
                    document.getElementById('label-description').scrollIntoView();
                    return false;
                }
                if ($('#meta_title').val() === '') {
                    $('#meta_title').notify('Bạn chưa chọn danh mục','error');
                    document.getElementById('meta_title').scrollIntoView();
                    return false;
                }
                if ($('#meta_description').val() === '') {
                    $('#meta_description').notify('Bạn chưa chọn danh mục','error');
                    document.getElementById('meta_description').scrollIntoView();
                    return false;
                }
            });
        });
    </script>

@endsection
