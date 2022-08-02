<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        @php
        $user = Auth::user()
        @endphp
        <div class="user-panel">
            <div class="pull-left image">
            @if ($user->avatar && file_exists(public_path($user->avatar)) )
                <img src="{{asset($user->avatar)}}" class="user-image" alt="">
            @else
                <img src="{{asset('upload/user/erro404.jpg')}}" class="user-image" alt="">
            @endif
            </div>
            <div class="pull-left info">
                <p>{{$user->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
            <li>
                <a href="{{route('admin.dashboard')}}">
                    <i class="fa fa-th"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.banner.index') }}">
                    <i class="fa fa-th"></i> <span>Banner</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.category.index') }}">
                    <i class="fa fa-th"></i> <span>Quản lý danh mục</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.article.index') }}">
                    <i class="fa fa-th"></i> <span>Quản lý bài viết</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.setting.index') }}">
                    <i class="fa fa-th"></i> <span>Cấu hình website</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.contact.index') }}">
                    <i class="fa fa-th"></i> <span>Danh sách liên hệ </span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.user.index') }}">
                    <i class="fa fa-th"></i> <span>Danh sách người dùng </span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.product.index') }}">
                    <i class="fa fa-th"></i> <span>Quản lý sản phẩm </span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.vendor.index') }}">
                    <i class="fa fa-th"></i> <span>Nhà cung cấp </span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.brand.index') }}">
                    <i class="fa fa-th"></i> <span>Thương hiệu </span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
    </section>
    <!-- /.sidebar -->
</aside>
