<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('backend') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
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
    </section>
    <!-- /.sidebar -->
</aside>
