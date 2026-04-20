@include('admin.blocks.header')
<div class="container body">
    <div class="main_container">
        @include('admin.blocks.sidebar')

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Quản lý người dùng</h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 form-group pull-right top_search">

                            <form method="GET" action="">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control"
                                        placeholder="Nhập thông tin user..." value="{{ request('keyword') }}">

                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit">Tìm kiếm</button>
                                    </span>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="x_panel">
                    <div class="x_content row">
                        @foreach ($users as $user)
                            <div class="col-md-4 col-sm-4  profile_details">
                                <div class="well profile_view">
                                    <div class="col-sm-12">
                                        <h4 class="brief"><i>{{ $user->isActive }}</i></h4>
                                        <div class="left col-md-7 col-sm-7">
                                            <h2>
                                                {{ $user->fullname }}

                                                @if($user->role == 'admin')
                                                    <span style="color:red;">[ADMIN]</span>
                                                @else
                                                    <span style="color:blue;">[USER]</span>
                                                @endif
                                            </h2>
                                            <p><strong>Name: </strong> {{ $user->username }} </p>
                                            <ul class="list-unstyled">
                                                <li><i class="fa fa-building"></i> Address: {{ $user->diachi }}</li>
                                                <li><i class="fa fa-phone"></i> Phone: {{ $user->sdt }}</li>
                                            </ul>
                                        </div>
                                        <div class="right col-md-5 col-sm-5 text-center">
                                            <img src="{{ asset('admin/assets/images/user-profile/' . $user->hinh) }}" alt=""
                                                class="img-circle img-fluid">
                                        </div>
                                    </div>
                                    <div class=" profile-bottom text-center">
                                        <div class=" col-sm-12 emphasis" style="display: flex; justify-content: end">
                                            @if ($user->isActive == 'Chưa kích hoạt')
                                                <button type="button" class="btn btn-primary btn-sm btn-active"
                                                    data-attr='{"userId": "{{ $user->userID }}", "action": "{{ route('admin.active-user') }}"}'
                                                    class="btn-active">
                                                    <i class="fa fa-check"> </i> Kích hoạt
                                                </button>
                                            @endif
                                            @if($user->role != 'admin')
                                                @if($user->trangthai == 'banned')
                                                    <button class="btn btn-success btn-unban"
                                                        data-attr='{"userId": "{{ $user->userID }}", "action": "{{ route('admin.status-user') }}", "status": ""}'>
                                                        Bỏ chặn
                                                    </button>
                                                @else
                                                    <button class="btn btn-warning btn-ban"
                                                        data-attr='{"userId": "{{ $user->userID }}", "action": "{{ route('admin.status-user') }}", "status": "b"}'>
                                                        Chặn
                                                    </button>
                                                @endif
                                             @endif

                                            @if($user->role != 'admin')
                                                @if($user->trangthai == 'deleted')
                                                    <button class="btn btn-info btn-restore"
                                                        data-attr='{"userId": "{{ $user->userID }}", "action": "{{ route('admin.status-user') }}", "status": ""}'>
                                                        Khôi phục
                                                    </button>
                                                @else
                                                    <button class="btn btn-danger btn-delete"
                                                        data-attr='{"userId": "{{ $user->userID }}", "action": "{{ route('admin.status-user') }}", "status": "d"}'>
                                                        Xóa
                                                    </button>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
    </div>
</div>
@include('admin.blocks.footer')