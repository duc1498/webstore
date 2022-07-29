
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
                    <form role="form" method="post" action="{{route('admin.user.update',  $user->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input value="{{$user->name}}" id="name" name="name" type="text" class="form-control" placeholder="">
                            </div>
                            @error('name')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputFile">avatar</label>
                                <input type="file" name="avatar" id="avatar">
                            </div>
                            @error('avatar')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            @if ($user->avatar && file_exists(public_path($user->avatar)) )
                                <img src="{{asset($user->avatar)}}" width="100px" height="75px" alt="">
                            @else
                                <img src="{{asset('upload/banner/erro404.jpg')}}"width="100px" height="75px" alt="">
                            @endif
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input value="" type="password" class="form-control" id="password" name="password" placeholder="">
                            </div>
                            @error('password')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email</label>
                                <input value="{{$user->email}}" type="email" class="form-control" id="email" name="email" placeholder="">
                            </div>
                            @error('email')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
                            <div class="checkbox">
                                <label>
                                    <input {{($user->is_active == 1) ? 'checked' : ''}}  value="1" type="checkbox" name="is_active" id="is_active"> Trạng thái
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">role_id</label>
                                <select class="form-control" name = "role_id">
                                @foreach (config('user.role_id') as $key => $item )
                                    <option
                                        value="{{$key}}"  {{($user->role_id == $key) ? 'selected' : ''}} type="text" class="form-control" id="role_id" name="role_id" placeholder=""> {{$item}}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            @error('role_id')
                            <p  style = "color : red;">{{ $message }}</p>
                            @enderror
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
