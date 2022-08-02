
@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Thêm category
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">General Elements</li>
        </ol>
    </section>
    <section class="content-header">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
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
                    <form role="form" method="post" action="{{route('admin.product.store')}}" enctype="multipart/form-data" id="form">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên</label>
                                <input id="name" name="name" type="text" class="form-control" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Chọn ảnh</label>
                                <input type="file" name="image" id="image">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Stock</label>
                                <input id="stock" name="stock" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">giá bán</label>
                                <input id="price" name="price" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">sale</label>
                                <input id="sale" name="sale" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Vị trí</label>
                                <input min="0" type="number" class="form-control" id="position" name="position" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">is_hot</label>
                                <input id="is_hot" name="is_hot" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">views</label>
                                <input id="views" name="views" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Chọn danh mục Cha</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option></option>
                                    @foreach ($category as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">liên kết</label>
                                <input id="url" name="url" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">sku</label>
                                <input id="sku" name="sku" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">color</label>
                                <input id="color" name="color" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">memory</label>
                                <input id="memory" name="memory" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                            <label>brand_id</label>
                            <select class="form-control" name="brand_id" id="brand_id">
                                <option></option>
                                @foreach ($brand as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>vendor_id</label>
                            <select class="form-control" name="vendor_id" id="vendor_id">
                                <option></option>
                                @foreach ($vendor as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">summary</label>
                                <input id="summary" name="summary" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">description</label>
                                <input id="description" name="description" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">meta_title</label>
                                <input id="meta_title" name="meta_title" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">meta_description</label>
                                <input id="meta_description" name="meta_description" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>user_id</label>
                                <select class="form-control" name="user_id" id="user_id">
                                    <option></option>
                                    @foreach ($user as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input value="1" type="checkbox" name="is_active" id="is_active"> Sản phẩm hot / flash sale </label>
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

            $('#price').on('keyup',function (e) {
                var price = $(this).val().replace(/[^0-9]/g,''); // lấy giá trị của ô sau khi nhập
                if (price > 0) {
                    price = parseInt(price.replaceAll(',','')); // thay thế dấu
                    price = new Intl.NumberFormat('ja-JP').format(price); // fomat định dạng rồi gán giá trị
                }
                $(this).val(price);
            });
            $('#sale').on('keyup',function (e) {
                var price = $(this).val().replace(/[^0-9]/g,'');
                if (price > 0) {
                    price = parseInt(price.replaceAll(',',''));
                    price = new Intl.NumberFormat('ja-JP').format(price);
                }
                $(this).val(price);

            });
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
