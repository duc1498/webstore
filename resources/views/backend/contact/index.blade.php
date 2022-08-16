@extends('backend.layouts.main')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Danh sach Liên hệ</h3>
                        @if (Auth::user()->role_id == 1)
                            <div class="form-group">
                                <select class="form-control" name="filter_type" id="filter_type"
                                    style="width: 150px ; float: left; margin: 0">
                                    <option {{ $filter_type == 1 ? 'selected' : '' }} value="1">Tất cả</option>
                                    <option {{ $filter_type == 2 ? 'selected' : '' }} value="2">Đang sử dụng</option>
                                    <option {{ $filter_type == 3 ? 'selected' : '' }} value="3">Đã xoá</option>
                                </select>
                            </div>
                        @endif
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">TT</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Content</th>
                                <th>open_time</th>
                            </tr>
                            @foreach ($contact as $key => $item)
                                <tr class="item-{{ $item->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>
                                        {{ $item->phone }}
                                    </td>
                                    <td>
                                        {{ $item->email }}
                                    </td>
                                    <td>
                                        {{ $item->content }}
                                    </td>
                                    <td>
                                        {{ $item->open_time }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.contact.edit', ['contact' => $item->id]) }}"><span
                                                title="Chỉnh sửa" type="button" class="btn btn-flat btn-primary"><i
                                                    class="fa fa-edit"></i></span></a>
                                                    @if ($item->deleted_at == null)
                                                    <span data-id="{{ $item->id }}"
                                                        data-url="{{ route('admin.contact.destroy', $item->id) }}" title="Xóa"
                                                        class="btn btn-flat btn-danger deleteItem"><i
                                                            class="fa fa-trash"></i></span>
                                                @else
                                                    <span data-id="{{ $item->id }}"
                                                        data-url="{{ route('admin.contact.restore', $item->id) }}"
                                                        title="Khôi phục" class="btn btn-flat btn-warning restoreItem"><i
                                                            class="fa fa-refresh"></i></span>
                                                @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        {{ $contact->links('backend.layouts.pagination') }}
                        {{-- <ul class="pagination pagination-sm no-margin pull-right">
              <li><a href="#">«</a></li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">»</a></li>
            </ul> --}}
                    </div>

                </div>
            </div>
            <!-- /.row -->
    </section>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {

            $('.deleteItem').click(function() {
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
                            url: url,
                            type: 'DELETE',
                            data: {},
                            success: function(res) {
                                if (res.success) {
                                    $('.item-' + id).remove();
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                }
                            },
                        });
                    }
                })
            });
            $('.restoreItem').click(function() {
                var id = $(this).attr('data-id');
                var url = $(this).attr('data-url');


                Swal.fire({
                    title: 'Are you sure?',
                    text: "dữ liệu sẽ được khôi phục",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {},
                            success: function(res) {
                                if (res.status) {
                                    Swal.fire(
                                        'Thông báo !',
                                        'Khôi phục thành công ',
                                        'success '
                                    );
                                } else {
                                    Swal.fire(
                                        'Thông báo !',
                                        'Có lỗi xảy ra ',
                                        'error '
                                    )
                                }
                            }
                        })
                    }
                })
            });

            $('#filter_type').change(function() { //bắt sự kiện
                var filter_type = $('#filter_type').val() //lấy giá trị của class
                window.location.href = "{{ route('admin.contact.index') }}?filter_type= " + filter_type;
            });
        });
    </script>
@endsection
