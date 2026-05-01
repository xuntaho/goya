
$(document).ready(function () {

    // 1. Cấu hình CSRF Token mặc định cho AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let isSubmitting = false;

    $(document).on('submit', '#formProfileAdmin', function (e) {
        e.preventDefault();
        return false;
    });

    
    
    // 3. Xử lý cập nhật thông tin (Tên, Email, Địa chỉ...)
    $('#btnUpdate').on('click', function (e) {
        e.preventDefault();
        if (isSubmitting) return;

        isSubmitting = true;
        const $btn = $(this);
        $btn.prop('disabled', true); // Khóa nút tránh click liên tục

        $.ajax({
            url: '/admin/update-admin',
            type: 'POST',
            data: $('#formProfileAdmin').serialize(),
            success: function (res) {
                if (res.success) {
                    toastr.success('Cập nhật thông tin thành công!');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    toastr.warning(res.message || 'Không có thay đổi!');
                    $btn.prop('disabled', false);
                }
            },
            error: function (xhr) {
                if (xhr.status !== 405) toastr.error('Lỗi hệ thống khi cập nhật!');
                $btn.prop('disabled', false);
            },
            complete: function () {
                isSubmitting = false;
            }
        });
    });

    // 4. Xử lý Upload Ảnh (Tách biệt hoàn toàn)
    $('#btn_avatar').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation(); // Ngăn chặn sự kiện lan tỏa lên form
        $('#avatarAdmin').click();
    });

    $('#avatarAdmin').on('change', function (e) {
        e.stopImmediatePropagation(); // Chặn đứng các event "rác" khác ngay lập tức
        
        let file = this.files[0];
        if (!file) return;

        // Hiển thị ảnh xem trước ngay lập tức (UI mượt hơn)
        let reader = new FileReader();
        reader.onload = function(e) {
            $('#crop-avatar img').attr('src', e.target.result);
        }
        reader.readAsDataURL(file);

        let formData = new FormData();
        formData.append('avatarAdmin', file);

        $.ajax({
            url: '/admin/update-avatar',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.success) {
                    toastr.success('Đã lưu ảnh đại diện mới!');
                } else {
                    toastr.error(res.message || 'Lỗi upload!');
                }
            },
            error: function (xhr) {
                // Chỉ hiện lỗi nếu không phải mã 405 (mã do browser tự trigger)
                if (xhr.status !== 405) {
                    toastr.error('Không thể upload ảnh lên server!');
                }
            }
        });
    });

    // 5. Global Ajax Error (Lọc bỏ các thông báo rác)
    $(document).ajaxError(function (event, xhr) {
    if (xhr.status === 405) return;

    if (xhr.status === 401 || xhr.status === 419) {
        // session hết hạn
        window.location.href = "/login"; 
    }
    });


$('.delete-tour').click(function () {

    let id = $(this).data('id');
    let url = $(this).data('url');

    if (!confirm('Xóa tour này?')) return;

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            alert('Xóa thành công');
            location.reload();
        }
    });

});

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
        minDate: 0 
    });

    });

    $('#btn-submit').click(function (e) {

        let title = $('input[name="title"]').val().trim();
        let diemden = $('input[name="diemden"]').val().trim();
        let mien = $('select[name="mien"]').val();
        let socho = $('input[name="socho"]').val();
        let giaLon = $('input[name="gia_nguoiLon"]').val();
        let giaBe = $('input[name="gia_emBe"]').val();
        let start = $('#start_date').val();
        let end = $('#end_date').val();

        // ===== TÊN =====
        if (title === "") {
            e.preventDefault();
            toastr.error("Vui lòng nhập tên tour!");
            return false;
        }

        // ===== ĐIỂM ĐẾN =====
        if (diemden === "") {
            e.preventDefault();
            toastr.error("Vui lòng nhập điểm đến!");
            return false;
        }

        // ===== MIỀN =====
        if (mien === "") {
            e.preventDefault();
            toastr.error("Vui lòng chọn khu vực!");
            return false;
        }

        // ===== SỐ CHỖ =====
        if (socho <= 0 || socho === "") {
            e.preventDefault();
            toastr.error("Số chỗ phải lớn hơn 0!");
            return false;
        }

        // ===== GIÁ =====
        if (giaLon <= 0 || giaLon === "") {
            e.preventDefault();
            toastr.error("Giá người lớn không hợp lệ!");
            return false;
        }

        if (giaBe < 0 || giaBe === "") {
            e.preventDefault();
            toastr.error("Giá trẻ em không hợp lệ!");
            return false;
        }

        
        if (!start || !end) {
            e.preventDefault();
            toastr.error("Vui lòng chọn đầy đủ ngày!");
            return false;
        }

        
        let s = new Date(start.split('-').reverse().join('-'));
        let eDate = new Date(end.split('-').reverse().join('-'));

        if (s > eDate) {
            e.preventDefault();
            toastr.error("Ngày kết thúc phải sau ngày bắt đầu!");
            return false;
        }

        
        let today = new Date();
        let maxDate = new Date();
        maxDate.setFullYear(today.getFullYear() + 2);

        if (s > maxDate || eDate > maxDate) {
            e.preventDefault();
            toastr.error("Ngày không được vượt quá 2 năm!");
            return false;
        }

        // PASS
        toastr.success("Dữ liệu hợp lệ!");
    });

});


$(document).on('click', '.btn-cancel', function (e) {

    e.preventDefault();

    let id = $(this).data('id');

    if (!confirm('Bạn có chắc muốn hủy booking?')) {
        return;
    }

    $.ajax({
        url: "/admin/booking/cancel",
        type: "POST",
        data: {
            bookingID: id,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            if (res.success) {
                toastr.success("Đã hủy booking!");
                location.reload();
            } else {
                toastr.error(res.message);
            }
        },
        error: function () {
            toastr.error("Lỗi hệ thống!");
        }
    });

});

$(document).on('click', '.btn-confirm, .confirm-booking', function (e) {

    e.preventDefault();

    let btn = $(this);
    let id = btn.data('id') || btn.data('bookingid');
    let url = btn.data('url');
     console.log(id, url);
    if (!confirm('Xác nhận booking này?')) return;

    btn.prop('disabled', true);

    $.ajax({
        url: url,
        type: "POST",
        data: {
            bookingId: id,
            _token: $('meta[name="csrf-token"]').attr('content')
        },

        success: function (res) {
            toastr.success(res.message || 'Đã xác nhận!');

            let row = btn.closest('tr');

            row.find('td:nth-child(9)')
                .html('<span style="color:green;">Đã xác nhận</span>');

            btn.remove();
        },

        error: function (xhr) {
            console.log(xhr.responseText);
            toastr.error('Lỗi xác nhận!');
            btn.prop('disabled', false);
        }
    });

});


document.addEventListener("DOMContentLoaded", function () {

    let el = document.getElementById('echart_donut');

    if (!el) return;

    let data = JSON.parse(el.getAttribute('data-payment-method'));
    let chartData = data.map(item => ({
        name: item.trangthai,
        value: item.total
    }));

    let chart = echarts.init(el);

    chart.setOption({
        tooltip: {
            trigger: 'item'
        },
        legend: {
            top: 'bottom'
        },
        series: [
            {
                name: 'Thanh toán',
                type: 'pie',
                radius: ['40%', '70%'],
                data: chartData
            }
        ]
    });

});
    
$('#form-km-edit').on('submit', function (e) {
    validateKM(e);
});
$('#form-km-create').on('submit', function (e) {
    validateKM(e);
});
function validateKM(e) {
    let discount = $('input[name="discount"]').val();
    let soluong = $('input[name="soluong"]').val();
    let start = $('#start_date').val();
    let end = $('#end_date').val();

    if (!discount || discount <= 0) {
        toastr.error("Giảm giá phải > 0");
        e.preventDefault();
        return false;
    }

    if (soluong < 0) {
        toastr.error("Số lượng không hợp lệ");
        e.preventDefault();
        return false;
    }

    if (!start || !end) {
        toastr.error("Vui lòng chọn ngày");
        e.preventDefault();
        return false;
    }

    let s = new Date(start.split('-').reverse().join('-'));
    let eDate = new Date(end.split('-').reverse().join('-'));

    if (s > eDate) {
        toastr.error("Ngày kết thúc phải sau ngày bắt đầu");
        e.preventDefault();
        return false;
    }
}