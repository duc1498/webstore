
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
                            @error('title')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputFile">Chọn ảnh</label>
                                <input type="file" name="image" id="image">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">slug</label>
                                <input id="slug" name="slug" type="text" class="form-control" placeholder="">
                            </div>
                            @error('slug')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputEmail1">summary</label>
                                <input id="summary" name="summary" type="text" class="form-control" placeholder="">
                            </div>
                            @error('summary')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label id="is_description">Mô tả</label>
                                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                            </div>
                            @error('description')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
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
                            @error('position')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="checkbox">
                                <label>
                                    <input value="1" type="checkbox" name="is_active" id="is_active"> hiển thị </label>
                            </div>

                            <div class="form-group">
                                <label id="is_description">Mô tả</label>
                                <textarea id="meta_description" name="meta_description" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                            </div>
                            @error('meta_description')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputEmail1">Meta_title</label>
                                <input id="meta_title" name="meta_title" type="text" class="form-control" placeholder="">
                            </div>
                            @error('meta_title')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
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
