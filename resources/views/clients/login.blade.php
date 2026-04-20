<head>
    <title>Goya - {{ $title }}</title>
    <link rel="icon" href="{{ asset('clients/assets/images/logos/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">

<!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CSS login -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css_login/style.css') }}">
</head>
<a href="{{ url('/') }}" style="
    position: fixed; 
    top: 15px; 
    left: 15px; 
    background: #00D084; 
    color: #fff; 
    padding: 8px 16px; 
    text-decoration: none; 
    z-index: 9999; 
    font-size: 14px;
    border-radius: 3px;
    border: 1px solid #fff;
">
    <i class="fa fa-chevron-left mr-2"></i>Quay lại
</a>



<div class=" login-page">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5 col-lg-5">
                    <div class="wrap">
                        <div class="img"
                            style="background-image: url({{ asset('clients/assets/images/login/bg-1.jpg') }});">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Đăng nhập</h3>
                                    <div id="error" class="alert alert-danger" style="display: none;"></div>
                                    <div id="message" class="alert alert-success" style="display: none;"></div>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end"> <a href="#"
                                            class="social-icon d-flex align-items-center justify-content-center"><span
                                                class="fa fa-facebook"></span></a> <a href="#"
                                            class="social-icon d-flex align-items-center justify-content-center"><span
                                                class="fa fa-google"></span></a> 
                                    </p>
                                </div>
                            </div>
                            <form action="{{ route('user-login') }}" method="POST" class="signin-form"
                                id="login-form-client"  >
                                @csrf
                                <div class="form-group mt-3">
                                    <input type="text" name="username" id="username-login" class="form-control"
                                        required>
                                    <label class="form-control-placeholder" for="username">Tên đăng nhập</label>
                                    <div class="invalid-feedback" id="validate_username"
                                        style="display:none; color:red;"></div>
                                </div>

                                <div class="form-group">
                                    <input name="password" id="password-login" type="password" class="form-control"
                                        required>
                                    <label class="form-control-placeholder" for="password">Mật khẩu</label>
                                    <span toggle="#password-login"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        <div class="invalid-feedback" id="validate_password"
                                        style="display:none; color:red;"></div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Đăng
                                        nhập</button>
                                </div>
                            </form>
                            <p class="text-center">Chưa có tài khoản? <a href="{{ route('dangky') }}">Đăng ký</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="{{ asset('clients/assets/css_login/js/jquery.min.js') }}"></script>
<script src="{{ asset('clients/assets/css_login/js/popper.js') }}"></script>
<script src="{{ asset('clients/assets/css_login/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('clients/assets/css_login/js/main.js') }}"></script>
<script src="{{ asset('clients/assets/js/custom.js') }}"></script>
<style>
    #message {
         white-space: nowrap;     /* không xuống dòng */
    width: fit-content;      /* tự giãn theo chữ */
    margin: 10px auto;       /* căn giữa */
    text-align: center;
    }
  #error {
    white-space: nowrap;     /* không xuống dòng */
    width: fit-content;      /* tự giãn theo chữ */
    margin: 10px auto;       /* căn giữa */
    text-align: center;
}
    
    .ftco-section {
        width: 100%;
        padding: 10px 0 30px;
    }

    .ftco-section .container {
        max-width: 500px !important;
        margin: 0 auto;
    }

    .login-page {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding-top: 70px;
        padding-bottom: 5px;
    }

    .wrap {
        max-width: 370px;
        width: 100%;
        margin: 0 auto;
    }
    

    .login-page .container {
        max-width: 1140px !important;
    }

    .login-wrap {
        width: 100%;
    }

    .img {
        height: 200px !important;
    }

    .login-wrap {
        padding: 14px !important;
    }

    .form-group+.form-group {
        margin-top: 28px;
    }

    h3 {
        font-size: 26px;
        margin-bottom: 10px !important;
    }

    .form-group.d-md-flex {
        margin-top: 10px;
    }
    .form-group {
    position: relative;
}

.field-icon {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    z-index: 999;
}

.form-control-placeholder {
    pointer-events: none;
}
</style>