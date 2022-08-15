@extends('backend.layouts.main')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Danh sach banner</h3>
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
                                        <span data-id="{{ $item->id }}"
                                            data-url="{{ route('admin.contact.destroy', $item->id) }}" title="Xóa"
                                            class="btn btn-flat btn-danger deleteItem"><i class="fa fa-trash"></i></span>
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
        });
    </script>
@endsection
