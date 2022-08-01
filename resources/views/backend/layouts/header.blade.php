<header class="main-header">
    <!-- Logo -->
    <a href="{{route('admin.dashboard')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        @if(Auth::check())
        @php
            $user = Auth::user()
        @endphp
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               @if ($user->avatar && file_exists(public_path($user->avatar)) )
                    <img src="{{asset($user->avatar)}}" class="user-image" alt="">
                @else
                    <img src="{{asset('upload/user/erro404.jpg')}}" class="user-image" alt="">
                @endif
              <span class="hidden-xs">{{$user->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
            <li class="user-header">
            @if ($user->avatar && file_exists(public_path($user->avatar)) )
                <img src="{{asset($user->avatar)}}" width="100px" height="75px" alt="">
            @else
                <img src="{{asset('upload/banner/erro404.jpg')}}"width="100px" height="75px" alt="">
            @endif
                <p>
                    {{$user->name}}
                </p>
            </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('admin.user.edit' , ['user' => $user->id])}}" class="btn btn-default btn-flat">Thiết lập</a>
                </div>
                <div class="pull-right">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                  <button type= "submit" class="btn btn-default btn-flat">Sign out</button>
                    </form>
                </div>
              </li>
            </ul>
          </li>
          @endif
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
</header>
