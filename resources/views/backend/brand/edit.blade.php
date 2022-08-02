
@extends('backend.layouts.main')

@section('content')
        <h1>
            chỉnh sửa
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Chỉnh sửa </li>
        </ol>
    </section>

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
                    <form role="form" method="post" action="{{route('admin.brand.update',  $brand->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input value="{{$brand->name}}" id="name" name="name" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Chọn ảnh</label>
                                <input type="file" name="image" id="image">
                            </div>
                            @if ($brand->image && file_exists(public_path($brand->image)) )
                                <img src="{{asset($brand->image)}}" width="100px" height="75px" alt="">
                            @else
                                <img src="{{asset('upload/category/erro404.jpg')}}"width="100px" height="75px" alt="">
                            @endif

                            <div class="form-group">
                                <label for="exampleInputEmail1">website</label>
                                <input value="{{$brand->website}}" id="website" name="website" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Vị trí</label>
                                <input value="{{$brand->position}}" min="0" type="number" class="form-control" id="position" name="position" placeholder="">
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input {{($brand->is_active == 1) ? 'checked' : ''}}  value="1" type="checkbox" name="is_active" id="is_active"> Trạng thái
                                </label>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Chỉnh sửa </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
