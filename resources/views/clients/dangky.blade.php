<head>
    <title>Goya - {{ $title }}</title>
    <!-- Favicon Icon -->
    <link rel="shortcut icon" href="{{ asset('clients/assets/images/logos/favicon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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
                                    <h3 class="mb-4">Đăng ký</h3>
                                    <div id="error" class="alert alert-danger" style="display: none;"></div>
                                    <div id="message" class="alert alert-success" style="display: none;"></div>
                                </div>
                            </div>
                            <form action="{{ route('dangky.post') }}" method="POST" class="signup-form"
                                id="register-form" novalidate>
                                @csrf <div class="form-group mt-3">
                                    <input type="text" name="useregister" id="username_reg" class="form-control"
                                        required>
                                    <label class="form-control-placeholder" for="username">Tên tài khoản</label>
                                    <div class="invalid-feedback" id="validate_username_reg"
                                        style="display:none; color:red;"></div>
                                </div>

                                <div class="form-group ">
                                    <input type="text" name="email" id="email_reg" class="form-control" required>
                                    <label class="form-control-placeholder" for="email">Email</label>
                                    <div class="invalid-feedback" id="validate_email_reg"
                                        style="display:none; color:red;">
                                    </div>
                                </div>

                                <div class="form-group position-relative">

                                    <input name="password" id="password_reg" type="password" class="form-control"
                                        required>
                                        <label class="form-control-placeholder">Mật khẩu</label>

                                    <span toggle="#password_reg"></span>

                                    

                                    <div class="invalid-feedback" id="validate_password_reg" style="display:none; color:red;"></div>

                                </div>
                                
                                <div class="form-group">
                                    <input id="re_password_reg" name="re_password" type="password" class="form-control"
                                        required>
                                    <label class="form-control-placeholder" for="re-password">Nhập lại mật khẩu</label>
                                    <span toggle="#re_password_reg"></span>
                                    <div class="invalid-feedback" id="validate_re_password"
                                        style="display:none; color:red;"></div>
                                </div>
                                

                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Đăng
                                        ký</button>
                                </div>
                            </form>
                            <p class="text-center">Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>

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
    white-space: nowrap;     
    width: fit-content;      
    margin: 10px auto;      
    text-align: center;
    }
   #error {
    white-space: nowrap;     
    width: fit-content;     
    margin: 10px auto;       
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
        padding-top: 10px;
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
        height: 170px !important;
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
        margin-top: -10px;
    }
.form-group {
    position: relative;
    margin-bottom: 25px; /* Tạo khoảng cách để không dính nhau */
}

    .field-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        cursor: pointer;
        z-index: 10;
        transform: translateY(-50%);
    }

    .form-control-placeholder {
        pointer-events: none;
    }
    
</style>