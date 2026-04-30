@if(session('role') == 'admin')
    <div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('admin.dashboard') }}" class="site_title"><i class="fa fa-paw"></i> <span>Admin</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ asset('admin/assets/images/user-profile/' . (session('avatar') ?? 'unnamed.png')) }}" class="img-circle profile_img">
            </div>  
            <div class="profile_info">
                <span>Xin chào,</span>
                <h2>{{ session('username') ?? 'Admin' }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Tổng quan</h3>
                <ul class="nav side-menu">
                    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a> </li>
                    <li><a href="{{ route('admin.users') }}"><i class="fa fa-users"></i> Quản lý người dùng</a> </li>
                    <li><a><i class="fa fa-plane"></i> Quản lý Tours<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('admin.tours.create') }}"><i class="fa fa-plus-square"></i> Thêm Tours</a></li>
                            <li><a href="{{ route('admin.tours') }}"> <i class="fa fa-list-alt"></i> Danh sách Tours</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('admin.booking') }}"><i class="fa fa-ticket"></i> Quản lý Booking</a> </li>
                    <li><a><i class="fa fa-tags"></i> Quản lý Khuyến mãi<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('admin.khuyenmai') }}"><i class="fa fa-plus-square"></i> Thêm Khuyến mãi</a></li>
                            <li><a href="{{ route('admin.listKM') }}"><i class="fa fa-list-alt"></i> Danh sách Khuyến mãi</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                        data-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('admin/assets/images/user-profile/' . (session('avatar') ?? 'unnamed.png')) }}" alt="">
                        @if(session('role') == 'admin')
                            {{ session('username') }}
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                            Thông tin cá nhân
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-sign-out pull-right"></i>
                            Đăng xuất</a>
                    </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                        data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green">
                            {{ isset($unreadCount) ? (is_array($unreadCount) || $unreadCount instanceof \Countable ? count($unreadCount) : (int) $unreadCount) : 0 }}
                        </span>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                        @foreach (($unreadContacts ?? collect())->take(3) as $item)
                            <li class="nav-item">
                                <a class="dropdown-item" href="{{ route('admin.contact') }}">
                                    <span>
                                        <b><span>{{ $item->username ?? '' }}</span></b>
                                        <span class="time">{{ $item->phoneNumber ?? '' }}</span>
                                    </span>
                                    <span class="message text-contact-truncate">
                                       {{ session('username') }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
@endif
