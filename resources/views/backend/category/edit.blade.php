
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
                    <form role="form" method="post" action="{{route('admin.category.update',  $category->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input value="{{$category->name}}" id="name" name="name" type="text" class="form-control" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Chọn ảnh</label>
                                <input type="file" name="image" id="image">
                            </div>
                            @if ($category->image && file_exists(public_path($category->image)) )
                                <img src="{{asset($category->image)}}" width="100px" height="75px" alt="">
                            @else
                                <img src="{{asset('upload/category/erro404.jpg')}}"width="100px" height="75px" alt="">
                            @endif

                            <div class="form-group">
                                <label>Chọn danh mục Cha</label>
                                <select class="form-control" name="parent_id" id="parent_id">
                                    <option></option>
                                    @foreach ($categories as $item)
                                        <option {{($item->id == $category->parent_id) ? 'selected' : ''}} value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại danh mục</label>
                                <select class="form-control" name="types" id="types">\
                                    <option></option>
                                    @foreach ( config('banner.types') as $key => $item )
                                    <option {{($category->types == $key) ? 'selected' : ''}} value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Vị trí</label>
                                <input value="{{$category->position}}" min="0" type="number" class="form-control" id="position" name="position" placeholder="">
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input {{($category->is_active == 1) ? 'checked' : ''}}  value="1" type="checkbox" name="is_active" id="is_active"> Trạng thái
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter ...">{{$category->description}}</textarea>
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
