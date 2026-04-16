@include('admin.blocks.header')
<div class="container body">
    <div class="main_container">
        @include('admin.blocks.sidebar')


        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Thông tin admin</h3>
                    </div>

                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-md-3 col-sm-3  profile_left">
                                    <div class="profile_img">
                                        <div id="crop-avatar">
                                            <!-- Current avatar -->
                                            <div class="profile_img">
                                                <div id="crop-avatar">

                                                    <!-- Avatar -->
                                                    <img id="previewAvatar" src="{{ $admin->hinh
                                                        ? asset('admin/assets/images/user-profile/' . $admin->hinh) . '?v=' . time()
                                                        : asset('admin/assets/images/user-profile/default.png') }}"
                                                        style="width:200px; height:200px; object-fit:cover; border-radius:50%; cursor:pointer;">

                                                    <!-- Input file -->
                                                    <input type="file" name="avatarAdmin" id="avatarAdmin"
                                                        style="display:none" accept="image/*">

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <br>
                                    <button type="button" id="btn_avatar" class="btn btn-success"
                                        style="width:58%; margin:10px 24px;">
                                        <i class="fa fa-edit m-right-xs"></i> Tải ảnh lên
                                    </button>
                                    @if($admin)
                                        <h3 id="nameAdmin">{{ $admin->username }}</h3>
                                    @endif
                                    <ul class="list-unstyled user_data">
                                        <li>
                                            <i class="fa fa-map-marker user-profile-icon"></i>
                                            <span id="emailAdmin">{{ $admin->email ?? '' }}</span>
                                        </li>
                                        <li>
                                            <i class="fa fa-briefcase user-profile-icon"></i>
                                            <span id="addressAdmin">{{ $admin->diachi ?? '' }}</span>
                                        </li>

                                    </ul>
                                    <br />

                                </div>
                                <div class="col-md-9 col-sm-9 ">
                                    <form id="formProfileAdmin" onsubmit="return false;">
                                        <div class="form-horizontal form-label-left">
                                            @csrf
                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                    for="fullName">Tên admin <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="text" id="username" name="username" required
                                                        class="form-control" placeholder="Nhập tên admin"
                                                        value="{{ $admin->username }}">
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                    for="password">Mật khẩu <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="password" name="password"
                                                        placeholder="Nhập nếu muốn đổi">
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label for="email"
                                                    class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input id="email" class="form-control" type="email" name="email"
                                                        required placeholder="Nhập email" value="{{ $admin->email }}">
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label for="address"
                                                    class="col-form-label col-md-3 col-sm-3 label-align">Địa chỉ</label>
                                                <div class="col-md-6 col-sm-6">
                                                    <input id="diachi" class="form-control" type="text" name="diachi"
                                                        required placeholder="Nhập địa chỉ"
                                                        value="{{ $admin->diachi }}">
                                                </div>
                                            </div>

                                            <div class="ln_solid"></div>

                                            <div class="item form-group">
                                                <div class="col-md-6 col-sm-6 offset-md-3">
                                                    <button type="button" id="btnUpdate" class="btn btn-success">Cập
                                                        nhật</button>
                                                </div>
                                            </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

    </div>
</div>

@include('admin.blocks.footer')