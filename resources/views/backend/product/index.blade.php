@extends('backend.layouts.main')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Danh sach quản lý sản phẩm </h3>
            <td>
                <a href="{{route('admin.product.create')}}" class="btn btn-primary pull-right">Thêm mới</a>
            </td>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
        <table class="table table-bordered">
            <tr>
                <th style="width: 10px">TT</th>
                <th>image</th>
                <th>name</th>
                <th>price</th>
                <th>sale</th>
                <th>user_id</th>
            </tr>
        @foreach ($product as $key=> $item )
            <tr class="item-{{$item->id}}">
                <td>{{$key + 1}}</td>
                <td>
                    @if ($item->image && is_file(public_path($item->image)) ) <!-- kiểm tra file có tồn tại hay ko -->
                        <img src="{{asset($item->image)}}" width="100px" height="75px" alt="">
                    @else
                        <img src="{{asset('upload/banner/erro404.jpg') }}"width="100px" height="75px" alt="">
                    @endif
                </td>
                <td>
                    {{$item->name}}
                </td>
                <td>
                    {{$item->price}}
                </td>
                <td>
                    {{$item->sale}}
                 </td>
                 <td>
                    {{$item->user_id}}
                 </td>
                <td>
                    <a href="{{ route('admin.product.edit', ['product' => $item->id]) }}"><span title="Chỉnh sửa" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>
                    <span data-id="{{ $item->id }}" data-url="{{route('admin.product.destroy', $item->id)}}" title="Xóa" class="btn btn-flat btn-danger deleteItem"><i class="fa fa-trash"></i></span>
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

@section('js')
    <script type="text/javascript">
        $( document ).ready(function() {

            $('.deleteItem').click(function () {
                var id = $(this).attr('data-id');
                var url = $(this).attr('data-url');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                    url : url,
                    type: 'DELETE',
                    data: {},
                    success: function (res) {
                        if(res ==1 ) {
                            $('.item-'+id).remove();
                        }
                    },
                });
            }
        })
    });
});
    </script>
@endsection

