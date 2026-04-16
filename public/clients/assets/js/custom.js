
$(document).ready(function () {

    // --- HEADER ---
     $('#userToggle').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation(); 
        $('#userDropdown').toggle();
    });

    $(document).on('click', function () {
        $('#userDropdown').hide();
    });


    //--- DATETIMEPICKER ---
    $(document).ready(function () {

    $('#start_date').datetimepicker({
        timepicker: false,
        format: 'd-m-Y'
    });

    $('#end_date').datetimepicker({
        timepicker: false,
        format: 'd-m-Y'
    });
    
     $('.datetimepicker').datetimepicker({
        format: 'd-m-Y',
        timepicker: false,
        minDate: 0 // 
    });

    });


    $('#message').hide();
    $('#error').hide();

    // --- LOGIN FORM ---
    $("#login-form-client").on("submit", function (e) {
        e.preventDefault();
        

        var userName = $("#username-login").val().trim();
        var password = $("#password-login").val().trim();

        $("#validate_username").hide().text("");
        $("#validate_password").hide().text("");

        var isValid = true;
        if (userName === "") {
        isValid = false;
        $("#validate_username").show().text("Vui lòng nhập tên đăng nhập");
        }

        if (password.length < 6) {
            isValid = false;
            $("#validate_password").show().text("Mật khẩu phải có ít nhất 6 ký tự");
        }

        var checkKTDB = /^[a-zA-Z0-9_]+$/;
        if (!checkKTDB.test(userName)) {
            isValid = false; 
            $("#validate_username").show().text("Tên đăng nhập không được chứa ký tự đặc biệt");
        }

        if (isValid) {
            var formData = {
            'username': userName,
            'password': password,
            '_token': $('input[name="_token"]').val()
    };
    console.log(formData);

    $.ajax({
        url: $(this).attr('action'),
        method: "POST",
        data: formData,
        success: function(response) {
            if(response.success) {
                $('#message').text(response.message).show();
                $('#error').hide();
                setTimeout(function(){
                    const params = new URLSearchParams(window.location.search);
                    const redirect = params.get("redirect");
                    const tourID = params.get("tourID");

                    if (redirect === "checkout" && tourID) {
                        window.location.href = "/checkout/" + tourID;
                    } else {
                        window.location.href = "/";
                    }
                }, 1000);
            } else {
                $('#message').hide();
                $('#error').text(response.message).show();
            }
        },
        error: function() {
            $('#error_login').text("Tài khoản hoặc mật khẩu không chính xác!").show();
        }
    });
}
    });

    // --- REGISTER FORM ---
    $("#register-form").on("submit", function (e) {
        e.preventDefault();

        var user = $("#username_reg").val().trim();
        var email = $("#email_reg").val().trim();
        var pass = $("#password_reg").val().trim();
        var rePass = $("#re_password_reg").val().trim();
        
        var isValid = true;
        var sqlPattern = /^[a-zA-Z0-9_]+$/;

        $(".invalid-feedback").hide().text("");

        if (user === "") {
            isValid = false;
            $("#validate_username_reg").text("Vui lòng nhập tên tài khoản").show();
        } else if (!sqlPattern.test(user)) {
            isValid = false;
            $("#validate_username_reg").text("Tên đăng nhập không được chứa ký tự đặc biệt").show();
        }

        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            isValid = false;
            $("#validate_email_reg").text("Email không đúng định dạng").show();
        }

        if (pass.length < 6) {
            isValid = false;
            $("#validate_password_reg").text("Mật khẩu tối thiểu 6 ký tự").show();
        }

        if (rePass !== pass) {
            isValid = false;
            $("#validate_re_password").text("Mật khẩu nhập lại không khớp").show();
        }

        if (isValid) {
            var formData = {
                'useregister': user,
                'email': email,
                'password': pass,
                '_token': $('input[name="_token"]').val() 
            };
            
        
    $.ajax({
    url: $(this).attr('action'),
        method: "POST",
        data: formData,
        success: function(response) {
            if(response.success) {
                $('#message').text(response.message).show();
                $('#error').hide();
                $('#register-form').trigger('reset');
            } else {
                $('#error').text(response.message).show();
                $('#message').hide();
            }
        },
        error: function() {
            $('#error').text("Có lỗi xảy ra!").show();
        }
    });
        }
    });

   
     // sap xep
    $('#orderBy').on('change', function() {
        filterTour();
    });

    // 2. Khi thay đổi các Radio (Miền, Sao, Thời gian)
    $('input[name="mien"], input[name="star"], input[name="thoigian"]').on('change', function() {
        filterTour();
    });

    // 3. Hàm lọc chính
    function filterTour() {
        var order = $('#orderBy').val() || "default";
        var price = $('#price').val();
        var mien = $('input[name="mien"]:checked').val() || "";
        var star = $('input[name="star"]:checked').val() || "";
        var thoigian = $('input[name="thoigian"]:checked').val() || "";

        var formDataFilter = {
            'order': order,
            'price': price,
            'mien': mien,
            'star': star,
            'thoigian': thoigian
        };

        $.ajax({
            url: filterToursUrl,
            method: "GET",
            data: formDataFilter,
            success: function(response) {
                $('#tours-container').html(response);
                var total = $('#tours-container').find('#tour-count-hidden').val() || 0;
                
                // 3. Hiển thị lên giao diện
                
                $('#total-tours').text(total + " tours được tìm thấy");
                $('#tours-container .destination-item').addClass('aos-animate');
                
                
                if (typeof AOS !== 'undefined') { 
                    AOS.refresh(); 
                }
            },
            error: function(err) {
                console.log("Lỗi rồi: ", err);
            }
        });
    }

    // 4. Sự kiện nút Xóa (Clear Filter)
    $('.clear_filter').on('click', function(e) {
        e.preventDefault();

        // Reset các giá trị về mặc định
        $('#orderBy').val('default');
        $('input[name="mien"], input[name="star"], input[name="thoigian"]').prop('checked', false);

        if ($(".price-slider-range").length) {
            // Đưa slider về mức ban đầu (ví dụ 0 đến 30 triệu)
            $(".price-slider-range").slider("values", [0, 30000000]);
            $("#price").val("0 đ - 30.000.000 đ"); 
        }

        // Gọi lại hàm lọc để server trả về full danh sách
        filterTour(); 
    });

    // thong tin user
      $(".updateUser").on("submit", function (e) {
        e.preventDefault();
        var fullname = $("#inputFullName").val();
        var diachi = $("#inputLocation").val();
        var email = $("#inputEmailAddress").val();
        var sdt = $("#inputPhone").val();
        var dataUpdate = {
            'fullname': fullname,
            'diachi': diachi,
            'email': email,
            'sdt': sdt,
            'token': $('input[name="_token"]').val(),
        };
        console.log(dataUpdate);
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: dataUpdate,
            success: function (response) {
                toastr.success(response.message);
                console.log(response.message);

                if (response.success) {
                   toastr.success(response.message);
                 } else {
                     toastr.error(response.message);
                 }
            },
            error: function (xhr, textStatus, errorThrown) {
                toastr.error("Có lỗi xảy ra.");
            },
        });

   
    });
    // --- ĐỔI MẬT KHẨU ---
    $("#change-password-form").on("submit", function (e) {
        e.preventDefault();
        let oldPass = $("#old_password").val();
        let newPass = $("#new_password").val();
        let confirmPass = $("#confirm_password").val();

        if (newPass.length < 6) {
            toastr.error("Mật khẩu mới phải từ 6 ký tự!"); return;
        }
        if (newPass !== confirmPass) {
           toastr.error("Xác nhận mật khẩu không khớp!"); return;
        }

        $.ajax({
            url: $(this).attr("action"),
            method: "POST",
            data: {
                old_password: oldPass,
                new_password: newPass,
                _token: $('input[name="_token"]').val()
            },
            success: function (res) {
            if (res.success) {
                toastr.success(res.message);
                
            } else {
                toastr.error(res.message);  
            }
            }
        });
    });

// --- CẬP NHẬT ẢNH ---
    $('#input-avatar-file').on('change', function() {
        var formData = new FormData();
        var file = $(this)[0].files[0]; // Lấy file đã chọn
        
        if (file) {
            formData.append('avatar', file); // 'avatar' phải khớp với $request->file('avatar') trong Controller
            formData.append('_token', $('input[name="_token"]').val());

            $.ajax({
                url: "/update-avatar", // Khớp với Route::post('/update-avatar', ...)
                type: 'POST',
                data: formData,
                contentType: false, // Bắt buộc khi gửi file
                processData: false, // Bắt buộc khi gửi file
                success: function(response) {
                    if (response.success) {
                        // 1. Thay đổi ảnh trên giao diện ngay lập tức
                        $('#avatar-preview').attr('src', response.image_url);
                        // 2. Hiện thông báo thành công
                        toast.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                   toastr.error("Không thể tải ảnh lên. Vui lòng kiểm tra lại kết nối hoặc kích thước file!");
                }
            });
        }
    });
});
    
let coupon = null;
// ===== TÍNH TỔNG TIỀN =====
function updateTotal() {
    let adult = document.getElementById('adult_count');
    let child = document.getElementById('child_count');

    if (!adult || !child) return;

    // ===== SỐ LƯỢNG =====
    let adultQty = parseInt(adult.value) || 0;
    let childQty = parseInt(child.value) || 0;

    // ===== GIÁ =====
    let adultPrice = parseInt(adult.dataset.price) || 0;
    let childPrice = parseInt(child.dataset.price) || 0;

    // ===== UPDATE UI =====
    document.querySelector('.quantity_adult').innerText = adultQty;
    document.querySelector('.quantity_child').innerText = childQty;

    // ===== TIỀN TỪNG LOẠI =====
    let adultTotal = adultQty * adultPrice;
    let childTotal = childQty * childPrice;

    document.querySelector('.adult_total').innerText =
        adultTotal.toLocaleString('vi-VN') + " VNĐ";

    document.querySelector('.child_total').innerText =
        childTotal.toLocaleString('vi-VN') + " VNĐ";

    // ===== TỔNG =====
    let total = adultTotal + childTotal;

    // ===== GIẢM GIÁ =====
    let discount = 0;

    if (coupon && coupon.discount > 0) {
        if (coupon.type === 'percent') {
            discount = total * coupon.discount / 100;
        } else {
            discount = coupon.discount;
        }
    }

    // ===== KHÔNG ÂM =====
    let finalTotal = total - discount;
    if (finalTotal < 0) finalTotal = 0;

    // ===== HIỂN THỊ =====
    document.querySelector('.discount_price').innerText =
        discount.toLocaleString('vi-VN') + " VNĐ";

    document.querySelector('.final_total').innerText =
        finalTotal.toLocaleString('vi-VN') + " VNĐ";
}

// ===== NÚT + - =====
document.querySelectorAll('.quantity-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        let input = this.parentElement.querySelector('input');

        let value = parseInt(input.value);
        let min = parseInt(input.min || 0);

        if (this.innerText.trim() === '+') {
            input.value = value + 1;
        } else {
            if (value > min) input.value = value - 1;
        }

        updateTotal();
    });
});

// ===== LOAD LẦN ĐẦU =====
document.addEventListener('DOMContentLoaded', function () {
    updateTotal();
});

// ===== ÁP DỤNG MÃ =====
function applyCoupon() {
    let code = document.getElementById('coupon_code').value;

    fetch('/check-coupon', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify({
            code: code,
            tourID: document.querySelector('input[name="tourID"]').value
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            coupon = {
                discount: parseFloat(data.discount),
                type: data.type
            };

            document.getElementById('coupon_hidden').value = code;

            toastr.success("Áp dụng thành công");
            updateTotal(); 
        } else {
            toastr.error(data.message);
        }
    });
}


let submitBtn = document.getElementById('submitBtn');

if (submitBtn) {
    submitBtn.addEventListener('click', function (e) {
       let name = document.getElementById('username').value.trim();
    let email = document.getElementById('email').value.trim();
    let phone = document.getElementById('phone').value.trim();

    let payment = document.querySelector('input[name="payment_method"]:checked');

    // ===== TÊN =====
    let nameRegex = /^[a-zA-ZÀ-ỹ\s]+$/;

    if (!name) {
        e.preventDefault();
        toastr.error("Vui lòng nhập họ tên");
        return;
    }

    if (!nameRegex.test(name)) {
        e.preventDefault();
        toastr.error("Tên không được chứa ký tự đặc biệt");
        return;
    }

    // ===== EMAIL =====
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!email) {
        e.preventDefault();
        toastr.error("Vui lòng nhập email");
        return;
    }

    if (!emailRegex.test(email)) {
        e.preventDefault();
        toastr.error("Email không đúng định dạng");
        return;
    }

    // ===== SĐT =====
    
    let phoneRegex = /^[0-9]{10,11}$/;

    if (!phone) {
        e.preventDefault();
        toastr.error("Vui lòng nhập số điện thoại");
        return;
    }

    
    if (!phoneRegex.test(phone)) {
        e.preventDefault();
        toastr.error("Số điện thoại chỉ được là số và phải đủ 10-11 chữ số");
        return;
    }

    // ===== THANH TOÁN =====
    if (!payment) {
        e.preventDefault();
        toastr.warning("Chọn phương thức thanh toán");
        return;
    }
if (payment.value === 'cash') {
    toastr.info("Thanh toán tại văn phòng");
}
    // ===== ĐỒNG Ý =====
    if (!document.getElementById('agree').checked) {
        e.preventDefault();
        toastr.warning("Bạn phải đồng ý điều khoản");
        return;
    }
    });
}
//

    // ===== THÔNG BÁO CASH =====

///xu ly nut dong y
document.addEventListener('DOMContentLoaded', function () {
    let agree = document.getElementById('agree');
    let btn = document.getElementById('submitBtn');

    if (agree && btn) {
        agree.addEventListener('change', function () {
            btn.disabled = !this.checked;
        });
    }
});

$(document).ready(function () {

    // ⭐ RATING STAR
    $(document).on('click', '#rating-stars i', function () {

    let value = $(this).data('value');

    $('#sosao').val(value);

    $('#rating-stars i').removeClass('fas').addClass('far');

    $('#rating-stars i').each(function (index) {
        if (index < value) {
            $(this).removeClass('far').addClass('fas');
        }
    });

    console.log("Đã chọn:", value);
});


});
$(document).ready(function () {
    console.log("SEARCH READY");

    $('.nav-search > button').on('click', function () {
        console.log("CLICKED"); // 👈 test
    });
});

