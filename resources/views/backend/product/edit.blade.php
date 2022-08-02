
@extends('backend.layouts.main')

@section('content')

        <h1>
            chỉnh sửa
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
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('admin.product.update',  $product->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">name</label>
                                <input value="{{$product->name}}" id="name" name="name" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Chọn ảnh</label>
                                <input type="file" name="image" id="image">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Stock</label>
                                <input value="{{$product->stock}}" id="stock" name="stock" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">price</label>
                                <input value="{{$product->price}}" id="price" name="price" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">sale</label>
                                <input value="{{$product->sale}}" id="sale" name="sale" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Vị trí</label>
                                <input value="{{$product->position}}" min="0" type="number" class="form-control" id="position" name="position" placeholder="">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input {{($product->is_active == 1) ? 'checked' : ''}}  value="1" type="checkbox" name="is_active" id="is_active"> Trạng thái
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">is_hot</label>
                                <input value="{{$product->is_hot}}" id="is_hot" name="is_hot" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">views</label>
                                <input value="{{$product->views}}" id="views" name="views" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option></option>
                                    @foreach ($category as $item)
                                        <option {{($item->id == $product->category_id) ? 'selected' : ''}}   value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">url</label>
                                <input value="{{$product->url}}" id="url" name="url" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">sku</label>
                                <input value="{{$product->sku}}" id="sku" name="sku" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">color</label>
                                <input value="{{$product->color}}" id="color" name="color" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">memory</label>
                                <input value="{{$product->memory}}" id="memory" name="memory" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                            <label>brand_id</label>
                            <select class="form-control" name="brand_id" id="brand_id">
                                <option></option>
                                @foreach ($brand as $key)
                                    <option {{($key->id == $product->brand_id) ? 'selected' : ''}}   value="{{$key->id}}">{{$key->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>vendor_id</label>
                            <select class="form-control" name="vendor_id" id="vendor_id">
                                <option></option>
                                @foreach ($vendor as $key)
                                    <option {{($key->id == $product->vendor_id) ? 'selected' : ''}}   value="{{$key->id}}">{{$key->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">summary</label>
                            <input value="{{$product->summary}}" id="summary" name="summary" type="text" class="form-control" placeholder="">
                        </div>
                            <div class="form-group">
                                <label>description</label>
                                <textarea value="{{$product->description}}" id="description" name="description" class="form-control" rows="3" placeholder=""></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Meta_title</label>
                                <input value="{{$product->meta_title}}" id="meta_title" name="meta_title" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>meta_description</label>
                                <textarea value="{{$product->meta_description}}" id="meta_description" name="meta_description" class="form-control" rows="3" placeholder=""></textarea>
                            </div>
                            <div class="form-group">
                                <label>user_id</label>
                                <select class="form-control" name="brand_id" id="brand_id">
                                    <option></option>
                                    @foreach ($user as $key)
                                        <option {{($key->id == $product->user_id) ? 'selected' : ''}}   value="{{$key->id}}">{{$key->name}}</option>
                                    @endforeach
                                </select>
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

@section('js')
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
