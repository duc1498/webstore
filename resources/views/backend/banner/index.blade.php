@extends('backend.layouts.main')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Danh sach banner</h3>
            <td>
                <a href="{{route('admin.banner.create')}}" class="btn btn-primary pull-right">Thêm mới</a>
            </td>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
        <table class="table table-bordered">
            <tr>
                <th style="width: 10px">TT</th>
                <th>Hinh anh</th>
                <th>Tên</th>
                <th>Loại</th>
                <th>Hành động</th>
            </tr>
        @foreach ($data as $key=> $item )
            <tr>
                <td>{{$key + 1}}</td>
                <td>
                    @if ($item->image && file_exists(public_path($item->image)) )
                        <img src="{{asset($item->image)}}" width="100px" height="75px" alt="">
                    @else
                        <img src="upload/banner/erro404.jpg"width="100px" height="75px" alt="">
                    @endif
                </td>
                <td>
                    {{$item->title}}
                </td>
                <td>
                    {{config('banner.type')[$item->type]}}
                </td>
                <td>
                    <a href="{{route('admin.banner.edit',['banner'=>$item->id])}}" class="fa fa-align-justify" aria-hidden="true"></a>
                    <a class="fa fa-trash" aria-hidden="true"></a>
                </td>
            </tr>
        @endforeach
        </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
              <li><a href="#">«</a></li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">»</a></li>
            </ul>
          </div>

      </div>
    </div>
    <!-- /.row -->
  </section>

@endsection

