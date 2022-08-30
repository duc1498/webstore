
@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
           Chỉnh sửa
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
                    <form role="form" method="post" action="{{route('admin.vendor.update', $vendor->id)}}" enctype="multipart/form-data" id="form">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input value="{{$vendor->name}}" id="name" name="name" type="text" class="form-control" placeholder="">
                            </div>
                            @error('title')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputFile">Chọn ảnh</label>
                                <input type="file" name="image" id="image">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">email</label>
                                <input value="{{$vendor->email}}" id="email" name="email" type="email" class="form-control" placeholder="">
                            </div>
                            @error('email')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputEmail1">phone</label>
                                <input value="{{$vendor->phone}}" id="phone" name="phone" type="text" class="form-control" placeholder="">
                            </div>
                            @error('phone')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputEmail1">website</label>
                                <input value="{{$vendor->website}}" id="website" name="website" type="text" class="form-control" placeholder="">
                            </div>
                            @error('website')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputEmail1">address</label>
                                <input value="{{$vendor->address}}" id="address" name="address" type="text" class="form-control" placeholder="">
                            </div>
                            @error('address')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputPassword1">Vị trí</label>
                                <input value="{{$vendor->position}}" min="0" type="number" class="form-control" id="position" name="position" placeholder="">
                            </div>
                            @error('position')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="checkbox">
                                <label>
                                    <input {{($vendor->is_active == 1) ? 'checked' : ''}}  value="1" type="checkbox" name="is_active" id="is_active"> hiển thị
                                </label>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btnCreate">Chỉnh sửa</button>
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
    <script type="text/javascript">
        $( document ).ready(function() {
            CKEDITOR.replace( 'summary' );
            CKEDITOR.replace( 'description' );
        });
    </script>
@endsection
