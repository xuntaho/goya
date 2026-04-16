<h3>Thanh toán Momo</h3>

<img src="https://via.placeholder.com/200">

<form action="/momo-success" method="POST">
    @csrf
    <input type="hidden" name="bookingID" value="{{ $booking->bookingID  }}">
    <button>Đã thanh toán</button>
</form>