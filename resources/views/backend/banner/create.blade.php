
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
                    <form role="form" method="post" action="{{route('banner.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tiêu đề</label>
                                <input required id="title" name="title" type="text" class="form-control" placeholder="">
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
                                    <option value="	_blank">_blank</option>
                                    <option value="_self">_self</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Loại</label>
                                <select class="form-control" name="type" id="type">
                                    <option value="1">Banner trang chủ</option>
                                    <option value="2">Banner quảng cáo trái</option>
                                    <option value="3">Banner quảng cáo phải</option>
                                    <option value="4">Background</option>
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
                                <label>Mô tả</label>
                                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Thêm</button>
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
