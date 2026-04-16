@include('clients.blocks.header')

@if($bookings->isEmpty())

    <div style="text-align:center; padding: 80px 0;">
        <h3>😢 Bạn chưa đặt tour nào</h3>
        <a href="{{ route('tours') }}" class="checkout-btn">
            Đặt tour ngay
        </a>
    </div>

@else

    @foreach($bookings as $tour)

    <section class="container" style="margin-top: 50px">

    <div class="checkout-container">

        <!-- Contact Information -->
        <div class="checkout-info">
            <h2 class="checkout-header">Thông Tin Liên Lạc</h2>
            <div class="checkout__infor">
                <div class="form-group">
                    <label>Họ và tên*</label>
                    <input type="text" value="{{ $tour->username }}" readonly>
                </div>

                <div class="form-group">
                    <label>Email*</label>
                    <input type="email" value="{{ $tour->email }}" readonly>
                </div>

                <div class="form-group">
                    <label>Số điện thoại*</label>
                    <input type="tel" value="{{ $tour->phone }}" readonly>
                </div>

                <div class="form-group">
                    <label>Địa chỉ*</label>
                    <input type="text" value="{{ $tour->address }}" readonly>
                </div>
            </div>

            <!-- Passenger Details -->
            <h2 class="checkout-header">Hành Khách</h2>

            <div class="checkout__quantity">
                <div class="form-group quantity-selector">
                    <label>Người lớn</label>
                    <div class="input__quanlity">
                        <input type="number" value="{{ $tour->adult_count }}" readonly>
                    </div>
                </div>

                <div class="form-group quantity-selector">
                    <label>Trẻ em</label>
                    <div class="input__quanlity">
                        <input type="number" value="{{ $tour->child_count }}" readonly>
                    </div>
                </div>
            </div>

            <!-- Payment Method -->
            <h2 class="checkout-header">Phương Thức Thanh Toán</h2>

            <label class="payment-option">
                <input type="radio" disabled {{ $tour->pthucTT == 'cash' ? 'checked' : '' }}>
                Thanh toán tại văn phòng
            </label>

            <label class="payment-option">
                <input type="radio" disabled {{ $tour->pthucTT == 'bank' ? 'checked' : '' }}>
                Thanh toán chuyển khoản
            </label>

            <label class="payment-option">
                <input type="radio" disabled {{ $tour->pthucTT == 'momo' ? 'checked' : '' }}>
                Thanh toán Momo
            </label>

        </div>

        <!-- Order Summary -->
        <div class="checkout-summary">
            <div class="summary-section">
                <div>
                    <p>Mã tour: {{ $tour->tourID }}</p>
                    <h4>{{ $tour->title }}</h4>
                    <p>Ngày khởi hành: {{ $tour->ngaybatdau }}</p>
                    <p>Ngày kết thúc: {{ $tour->ngayketthuc }}</p>
                </div>

                <div class="order-summary">
                    <div class="summary-item">
                        <span>Người lớn:</span>
                        <div>
                            <span>{{ $tour->adult_count }}</span>
                        </div>
                    </div>

                    <div class="summary-item">
                        <span>Trẻ em:</span>
                        <div>
                            <span>{{ $tour->child_count }}</span>
                        </div>
                    </div>

                    <div class="summary-item total-price">
                        <span>Tổng cộng:</span>
                        <span>{{ number_format($tour->total_price) }} VNĐ</span>
                    </div>
                </div>

                <!-- TRẠNG THÁI -->
                <p>
                    Trạng thái:
                    <b style="color:
                        @if($tour->status == 'pending') orange
                        @elseif($tour->status == 'confirmed') green
                        @else red
                        @endif
                    ">
                        {{ $tour->status }}
                    </b>
                </p>

                <!-- NÚT HỦY -->
                @php
                    $days = \Carbon\Carbon::now()->diffInDays(
                        \Carbon\Carbon::parse($tour->ngaybatdau),
                        false
                    );
                @endphp

                @if($tour->status != 'cancelled' && $days >= 7)
                    <a href="{{ route('booking.cancel', $tour->bookingID) }}"
                       class="checkout-btn"
                       style="background:red"
                       onclick="return confirm('Bạn chắc chắn muốn hủy tour?')">
                        Hủy tour
                    </a>
                @else
                    <button class="checkout-btn" style="background:gray" disabled>
                        Không thể hủy
                    </button>
                @endif
                @php
                    $isFinished = now()->gt(\Carbon\Carbon::parse($tour->ngayketthuc));
                @endphp

                @if($isFinished && $tour->status == 'confirmed' && !$tour->review_id)

                <a href="{{ route('chitiet_tour', $tour->tourID) }}?bookingID={{ $tour->bookingID }}"
                class="checkout-btn"
                style="background:green">
                    Đánh giá
                </a>
                @endif
                @if($tour->review_id)
                    <span style="color:gray">✔ Đã đánh giá</span>
                @endif

            </div>
        </div>

    </div>

</section>

    @endforeach

@endif

@include('clients.blocks.footer')

