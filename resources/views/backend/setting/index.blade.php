
@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Cấu hình website
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
                    <form role="form" method="post" action="{{route('admin.setting.store')}}" enctype="multipart/form-data" id="form">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">

                                <label for="exampleInputEmail1">Tên công ty</label>
                                <input value="{{$setting->company}}" id="company" name="company" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Logo</label>
                                <input type="file" name="image" id="image">
                            </div>
                            @if ($setting->image && is_file(public_path($setting->image)) )
                                <img src="{{asset($setting->image)}}" width="100px" height="75px" alt="">
                            @else
                                {{-- <img src="{{asset(upload/category/erro404.jpg)}}"width="100px" height="75px" alt=""> --}}
                            @endif

                            <div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ 1</label>
                                <input value="{{$setting->address}}" id="address" name="address" type="text" class="form-control" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ 2 </label>
                                <input value="{{$setting->address2}}" id="address2" name="address2" type="text" class="form-control" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại </label>
                                <input value="{{$setting->phone}}" id="phone" name="phone" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email </label>
                                <input value="{{$setting->email}}" id="email" name="email" type="text" class="form-control" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã số thuế</label>
                                <input value="{{$setting->tax}}" id="tax" name="tax" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Facebook</label>
                                <input value="{{$setting->facebook}}" id="facebook" name="facebook" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">open_time</label>
                                <input value="{{$setting->open_time}}" id="open_time" name="open_time" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label id="is_description">Giới thiệu</label>
                                <textarea id="content" name="content" class="form-control" rows="3" placeholder="Enter ...">{{$setting->content}}</textarea>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btnCreate">Cập nhập</button>
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


{{-- @section('js')
    <script>
        $(document).ready(function() {
            CKEDITOR.replace( 'content' )
            $('.btnCreate').click(function () {
                var error_mess = {};
                var att = ['title', 'image','address','address2','phone','email','tax','facebook'];
                var vi = [];
                vi['title'] = 'tieu de';
                vi['url'] = 'ảnh';
                vi['address'] = 'Địa chỉ 1';
                vi['address2'] = 'Địa chỉ 2';
                vi['phone'] = 'phone';
                vi['email'] = 'email';
                vi['tax'] = 'tax';
                vi['facebook'] = 'facebook';
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

    </script>
@endsection --}}
