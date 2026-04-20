@include('clients.blocks.header')

<div class="user_infor">
    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-xl-4">

                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Ảnh đại diện</div>
                    <div class="card-body text-center">

                        <img id="avatar-preview" class="img-account-profile rounded-circle mb-2"
                        src="{{ asset('clients/assets/images/users/' . ($user->hinh ?? 'default.png')) }}"
                        alt="Ảnh đại diện">

                        <div class="small font-italic text-muted mb-4">JPG hoặc PNG không lớn hơn 5 MB</div>

                        <input type="file" id="input-avatar-file" style="display:none" accept="image/*">
                        <button class="btn btn-primary" type="button" onclick="$('#input-avatar-file').click()">
                            Tải ảnh lên
                        </button>
                    </div>
                    <div class="card-body text-center" style="background-color: grey; margin-top: 10px;">
                        <form action="{{ route('update-password') }}" id="change-password-form" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="small mb-1" for="old_password">Mật khẩu hiện tại</label>
                                <input class="form-control" id="old_password" name="old_password" type="password"
                                    placeholder="Nhập mật khẩu cũ" value="">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="new_password">Mật khẩu mới</label>
                                <input class="form-control" id="new_password" name="new_password" type="password"
                                    placeholder="Nhập mật khẩu mới" value="">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="confirm_password">Xác nhận mật khẩu</label>
                                <input class="form-control" id="confirm_password" name="confirm_password"
                                    type="password" placeholder="Nhập lại mật khẩu mới" value="">
                            </div>


                            <button class="btn btn-primary" type="submit">Thay đổi mật khẩu</button>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-8">

                <div class="card mb-4">
                    <div class="card-header">Thông tin tài khoản</div>
                    <div class="card-body">
                        <form action="{{ route('update-infor') }}" method="POST" class="updateUser">
                            @csrf
                            <div class="mb-3">
                                <label class="small mb-1" for="inputFullName">Họ và tên</label>
                                <input class="form-control" name="fullname" id="inputFullName" type="text"
                                    placeholder="Nhập họ và tên của bạn" value="{{ $user->fullname ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputLocation">Địa chỉ</label>
                                <input class="form-control" name="diachi" id="inputLocation" type="text"
                                    placeholder="Nhập địa chỉ của bạn" value="{{ $user->diachi ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                <input class="form-control" name="email" id="inputEmailAddress" type="email"
                                    placeholder="Nhập địa chỉ email của bạn" value="{{ $user->email ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPhone">Số điện thoại</label>
                                <input class="form-control" name="sdt" id="inputPhone" type="text"
                                    placeholder="Nhập số điện thoại của bạn" value="{{ $user->sdt ?? '' }}" required>
                            </div>
                            <button class="btn btn-primary" type="submit" id="update">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@include('clients.blocks.footer')