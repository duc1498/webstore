
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
                    <form role="form" method="post" action="{{route('admin.contact.update',  $contact->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">name</label>
                                <input value="{{$contact->name}}" id="name" name="name" type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">phone</label>
                                <input value="{{$contact->phone}}" id="phone" name="phone" type="numbet" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">email</label>
                                <input value="{{$contact->email}}" id="email" name="email" type="email" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Open_time</label>
                                <input value="{{$contact->open_time}}" id="open_time" name="open_time" type="email" class="form-control" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Content</label>
                                <textarea value="{{$contact->content}}" id="content" name="content" class="form-control" rows="3" placeholder="Enter ..."></textarea>
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
