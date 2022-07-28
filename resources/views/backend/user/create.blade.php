
@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Thêm User
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">General Elements</li>
        </ol>
    </section>
    <section class="content-header">
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm mới User</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('admin.user.store')}}" enctype="multipart/form-data" id="form">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input id="name" name="name" type="text" class="form-control" placeholder="">
                            </div>
                            @error('name')
                            <p style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputFile">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            @error('email')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="">
                            </div>
                            @error('password')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputPassword1">Role_id</label>
                                <select class="form-control" name = "role_id">
                                <option> </option>
                                @foreach (config('user.role_id')  as $key => $item  )
                                <option type="text" class="form-control" id="Role_id" name="Role_id" placeholder=""  value="{{ $key }} " {{(Request::old('role_id') == $key) ? 'selected' : ''}} >{{$item}}</option>
                                @endforeach
                                </select>
                            </div>
                            @error('role_id')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputFile">Avatar</label>
                                <input type="file" name="avatar" id="avatar">
                            </div>
                            @error('avatar')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="checkbox">
                                <label>
                                    <input value="1" type="checkbox" name="is_active" id="is_active"> Trạng thái
                                </label>
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
