@include('clients.blocks.header')


<section class="container" style="margin-top: 50px">


    <form action="{{ route('checkout.store') }}" method="POST" class="checkout-container">
        @csrf
        <input type="hidden" name="tourID" value="{{ $tour->tourID }}">
        <input type="hidden" name="coupon_code" id="coupon_hidden">
        <!-- Contact Information -->
        <div class="checkout-info">
            <h2 class="checkout-header">Thông Tin Liên Lạc</h2>
            <div class="checkout__infor">
                <div class="form-group">
                    <label for="username">Họ và tên*</label>
                    <input type="text" id="username" placeholder="Nhập Họ và tên" name="username" value="{{ $user->username ?? '' }}" required>
                    
                </div>

                <div class="form-group">
                    <label for="email">Email*</label>
                   
                    <input type="email" id="email" name="email" placeholder="sample@gmail.com"  value="{{ $user->email ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label for="tel">Số điện thoại*</label>
                    <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại liên hệ"
                        value="{{ $user->phone ?? '' }}" required>
                   
                </div>

                <div class="form-group">
                    <label for="address">Địa chỉ*</label>
                    <input type="text" id="address" name="address" placeholder="Nhập địa chỉ liên hệ" 
                         value="{{ $user->address ?? '' }}" required>
                    
                </div>
            </div>


            <!-- Passenger Details -->
            <h2 class="checkout-header">Hành Khách</h2>

            <div class="checkout__quantity">
                <div class="form-group quantity-selector">
                    <label>Người lớn</label>
                    <div class="input__quanlity">
                        <button type="button" class="quantity-btn">-</button>
                        <input type="number" name="adult_count" class="quantity-input" id="adult_count" value="1" min="1"
                            data-price="{{ $tour->gia_nguoiLon }}" readonly>
                        <button type="button" class="quantity-btn">+</button>
                    </div>
                </div>

                <div class="form-group quantity-selector">
                    <label>Trẻ em</label>
                    <div class="input__quanlity">
                        <button type="button" class="quantity-btn">-</button>
                        <input type="number" name="child_count" class="quantity-input" id="child_count" value="0"
                            data-price="{{ $tour->gia_emBe }}" readonly>
                        <button type="button" class="quantity-btn">+</button>
                    </div>
                </div>
            </div>
            <!-- Privacy Agreement Section -->
            <div class="privacy-section">
                <p>Bằng cách nhấp chuột vào nút "ĐỒNG Ý" dưới đây, Khách hàng đồng ý rằng các điều kiện điều khoản
                    này sẽ được áp dụng. Vui lòng đọc kỹ điều kiện điều khoản trước khi lựa chọn sử dụng dịch vụ của
                    GOYA Tours.</p>
                <div class="privacy-checkbox">
                    <input type="checkbox" id="agree" name="agree" required>
                    <label for="agree">Tôi đã đọc và đồng ý với <a href="#" target="_blank">Điều khoản thanh
                            toán</a></label>
                </div>
            </div>
            <!-- Payment Method -->
            <h2 class="checkout-header">Phương Thức Thanh Toán</h2>

            <label class="payment-option">
                <input type="radio" name="payment_method" value="cash" required>
                <img src="{{ asset('clients/assets/images/contact/icon.png') }}">

                Thanh toán tại văn phòng
            </label>

            <label class="payment-option">
                <input type="radio" name="payment_method" value="bank" required>
                <img src="{{ asset('clients/assets/images/checkout/cong-thanh-toan-paypal.jpg') }}">
                Thanh toán bằng chuyển khoản
            </label>

            <label class="payment-option">
                <input type="radio" name="payment_method" value="momo" required>
                <img src="{{ asset('clients/assets/images/checkout/thanh-toan-momo.jpg') }}">

                Thanh toán bằng Momo
            </label>


        </div>

        <!-- Order Summary -->
        <div class="checkout-summary">
            <div class="summary-section">
                <div>
                    <p>Mã tour: {{ $tour->tourID }} </p>
                    
                    <h4>{{ $tour->title }}</h4>
                    <p>Ngày khởi hành : {{ $tour->ngaybatdau }}</p>

                    <p>Ngày kết thúc : {{ $tour->ngayketthuc }} </p>
                </div>

                <div class="order-summary">
                    <div class="summary-item">
                        <span>Người lớn:</span>
                        <div>
                            <span class="quantity_adult">0</span>
                            <span>x</span>
                            <span class="adult_total">0 VND</span>
                        </div>
                    </div>
                    <div class="summary-item">
                        <span>Trẻ em:</span>
                        <div>
                            <span class="quantity_child">0</span>
                            <span>x</span>
                            <span class="child_total">0 VND</span>
                        </div>
                    </div>
                    <div class="summary-item">
                        <span>Giảm giá:</span>
                        <div>

                            <span class="discount_price">0 VNĐ</span>
                        </div>
                    </div>
                    @if($coupon)
                        <p style="color: green; font-size: 16px; margin-bottom: 5px;">
                            🎁Nhập mã <b>{{ $coupon->code }}</b> - nhận ngay mã giảm 
                            <b>
                                {{ $coupon->type == 'percent' 
                                    ? $coupon->discount . '%' 
                                    : number_format($coupon->discount) . ' VNĐ' }}
                            </b>
                        </p>
                    @endif
                    <div class="order-coupon">
                       
                        <input type="text" id="coupon_code" placeholder="Mã giảm giá" style="width: 60%">
                        <button type="button" style="width: 30%" onclick="applyCoupon()">Áp dụng</button>
                    </div>
                    <div class="summary-item total-price">
                        <span>Tổng cộng:</span>
                        <span class="final_total">0 VNĐ</span>
                    </div>
                </div>

                <button type="submit" id="submitBtn" class="checkout-btn">Xác Nhận và Thanh Toán</button>
            </div>
        </div>
    </form>
</section>

@include('clients.blocks.footer')