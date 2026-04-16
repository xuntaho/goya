<h3>Chuyển khoản ngân hàng</h3>

<p>Ngân hàng: Á Châu</p>
<p>STK: 123456789</p>
<p>Tên: VO THI XUAN TAHO</p>

<p>Nội dung: <b>DATTOUR_{{ $booking->bookingID }}</b></p>

<img src="https://img.vietqr.io/image/mb-123456789-compact.png?amount=100000&addInfo=DATTOUR{{$booking->bookingID}}">

<form action="/bank-success" method="POST">
    @csrf
    <input type="hidden" name="bookingID" value="{{ $booking->bookingID }}">
    <button>Xác nhận đã chuyển</button>
</form>