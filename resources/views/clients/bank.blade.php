<title>Thanh toán MoMo</title>
<link rel="shortcut icon" href="{{ asset('clients/assets/images/logos/favicon.png') }}" type="image/x-icon">
@php
    $info = 'DT'.$data->bookingID.'_'.$data->phone;
@endphp

<div class="payment-container">
    <div class="payment-card">

        <h3>Thanh toán chuyển khoản</h3>

        <div class="amount">
           Số tiền: {{ number_format($data->total_price,0,',','.') }} VNĐ
        </div>

        <div class="bank-info">
            <p><b>Ngân hàng:</b> Á Châu (ACB)</p>
            <p><b>Số tài khoản:</b> 123456789</p>
            <p><b>Chủ tài khoản:</b> CONG TY GOYA</p>

            <hr>

            <p><b>Người đặt:</b> {{ $data->username }}</p>
            <p><b>Email:</b> {{ $data->email }}</p>
            <p><b>SĐT:</b> {{ $data->phone }}</p>
        </div>

        <div class="highlight">
            {{ $info }}
            <button class="copy-btn" onclick="copyContent()">Copy</button>
        </div>
        <div class="success-msg" id="copy-msg">✔ Đã copy</div>

        <div class="qr-img">
            <img src="https://img.vietqr.io/image/mb-123456789-compact.png?amount={{ $data->total_price }}&addInfo={{ urlencode($info) }}">
        </div>

        <p style="color:red; font-size:13px;">
            ⚠ Vui lòng chuyển đúng nội dung để hệ thống xác nhận
        </p>

        <form id="payment-form" action="/bank-success" method="POST">
            @csrf
            <input type="hidden" name="bookingID" value="{{ $data->bookingID }}">
            <button class="btn-pay" id="btn-pay">Tôi đã chuyển khoản</button>
        </form>

    </div>
</div>
<style>
.payment-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 90vh;
    background: #f5f7fa;
}

.payment-card {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    width: 420px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    text-align: center;
}

.payment-card h3 {
    margin-bottom: 15px;
    font-weight: 600;
}

.amount {
    font-size: 22px;
    font-weight: bold;
    color: #e74c3c;
    margin-bottom: 15px;
}

.bank-info {
    text-align: left;
    margin-bottom: 15px;
}

.bank-info p {
    margin: 5px 0;
}

.highlight {
    background: #eef2f7;
    padding: 10px;
    border-radius: 8px;
    font-weight: bold;
    text-align: center;
    margin-top: 10px;
    position: relative;
}

.copy-btn {
    position: absolute;
    right: 10px;
    top: 8px;
    font-size: 12px;
    background: #007bff;
    color: white;
    border: none;
    padding: 3px 8px;
    border-radius: 5px;
    cursor: pointer;
}

.qr-img img {
    width: 200px;
    border-radius: 10px;
    border: 1px solid #ddd;
    margin: 20px 0;
}

.btn-pay {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 10px;
    background: linear-gradient(135deg, #00c6ff, #0072ff);
    color: #fff;
    font-weight: bold;
    font-size: 16px;
    transition: 0.3s;
}

.btn-pay:hover {
    opacity: 0.9;
}

.success-msg {
    color: green;
    font-size: 13px;
    margin-top: 5px;
    display: none;
}
</style>

<script>
function copyContent() {
    let text = "{{ $info }}";
    navigator.clipboard.writeText(text);

    document.getElementById("copy-msg").style.display = "block";

    setTimeout(() => {
        document.getElementById("copy-msg").style.display = "none";
    }, 2000);
}

// 🔥 LOADING BUTTON
document.getElementById("payment-form").addEventListener("submit", function(){
    document.getElementById("btn-pay").innerText = "Đang xử lý...";
});
</script>