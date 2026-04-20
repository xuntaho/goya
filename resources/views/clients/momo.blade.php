<title>Thanh toán MoMo</title>
<link rel="shortcut icon" href="{{ asset('clients/assets/images/logos/favicon.png') }}" type="image/x-icon">
@php
    $info = 'MOMO'.$data->bookingID.'_'.$data->phone;
@endphp

<div class="payment-container">
    <div class="payment-card">

        <h3>Thanh toán MoMo</h3>

        <div class="amount">
            Số tiền: {{ number_format($data->total_price,0,',','.') }} VNĐ
        </div>

        <div class="bank-info">
            <p><b>Ví:</b> MoMo</p>
            <p><b>SĐT nhận:</b> 0909123456</p>
            <p><b>Chủ ví:</b> CONG TY GOYA</p>

            <hr>

            <p><b>Người đặt:</b> {{ $data->username }}</p>
            <p><b>SĐT:</b> {{ $data->phone }}</p>
        </div>

        <div class="highlight">
            {{ $info }}
            <button class="copy-btn" onclick="copyContent()">Copy</button>
        </div>
        <div class="success-msg" id="copy-msg">Đã copy</div>

        <div class="qr-img">
           <img src="{{ asset('clients/assets/images/checkout/momo.jpg') }}">
        </div>

        <p style="color:red; font-size:13px;">
            ⚠ Vui lòng nhập đúng nội dung để hệ thống xác nhận
        </p>

        <form id="payment-form" action="/momo-success" method="POST">
            @csrf
            <input type="hidden" name="bookingID" value="{{ $data->bookingID }}">
            <button class="btn-pay" id="btn-pay">Tôi đã thanh toán</button>
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
    color: #d81b60;
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
    background: #fce4ec;
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
    background: #d81b60;
    color: white;
    border: none;
    padding: 3px 8px;
    border-radius: 5px;
    cursor: pointer;
}

.qr-img img {
    width: 300px;
    border-radius: 10px;
    border: 1px solid #ddd;
    margin: 20px 0;
}

.btn-pay {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 10px;
    background: linear-gradient(135deg, #ff4081, #d81b60);
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

document.getElementById("payment-form").addEventListener("submit", function(){
    document.getElementById("btn-pay").innerText = "Đang xử lý...";
});
</script>