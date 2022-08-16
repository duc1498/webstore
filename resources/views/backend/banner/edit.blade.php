
@extends('backend.layouts.main')

@section('content')

        <h1>
            chỉnh sửa
        </h1>
                        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">General Elements</li>
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
                    <form role="form" method="post" action="{{route('admin.banner.update',  $banner->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tiêu đề</label>
                                <input value="{{$banner->title}}" id="title" name="title" type="text" class="form-control" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Chọn ảnh</label>
                                <input type="file" name="image" id="image">
                            </div>
                            @if ($banner->image && file_exists(public_path($banner->image)) )
                                <img src="{{asset($banner->image)}}" width="100px" height="75px" alt="">
                            @else
                                <img src="{{asset('upload/banner/erro404.jpg')}}"width="100px" height="75px" alt="">
                            @endif
                            <div class="form-group">
                                <label for="exampleInputPassword1">Liên kết</label>
                                <input value="{{$banner->url}}" type="text" class="form-control" id="url" name="url" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Chọn Target</label>
                                <select class="form-control" name="target" id="target">
                                    @foreach ( config('banner.target') as $key => $target )
                                    <option {{($banner->target == $key) ? 'selected' : ''}} value="{{$key}}">{{$target}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Loại</label>
                                <select class="form-control" name="type" id="type">
                                    @foreach (config('banner.type') as $key => $type )
                                        <option {{($banner->title == $key) ? 'selected' : ''}} value="{{$key}}">{{$type}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Vị trí</label>
                                <input value="{{$banner->position}}" min="0" type="number" class="form-control" id="position" name="position" placeholder="">
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input {{($banner->is_active == 1) ? 'checked' : ''}}  value="1" type="checkbox" name="is_active" id="is_active"> Trạng thái
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter ...">{{$banner->description}}</textarea>
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
