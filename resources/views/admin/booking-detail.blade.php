@include('admin.blocks.header')

<div class="container body">
    <div class="main_container">
        @include('admin.blocks.sidebar')

```
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Hóa đơn <small>đặt tour</small></h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="invoice_booking">
                            <div class="x_title">
                                <h2>Hóa đơn chi tiết</h2>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">
                                <section class="content invoice">

                                    {{-- HEADER --}}
                                    <div class="row">
                                        <div class="invoice-header">
                                            <h3>
                                                {{ $booking->tour_name }}

                                                <small class="pull-right">
                                                    Ngày đặt:
                                                    {{ date('d-m-Y', strtotime($booking->booking_date)) }}
                                                </small>
                                            </h3>
                                        </div>
                                    </div>

                                    {{-- INFO --}}
                                    <div class="row invoice-info">

                                        <div class="col-sm-4">
                                            <b>Khách hàng</b>
                                            <p>
                                                {{ $booking->username }} <br>
                                                {{ $booking->email }} <br>
                                                {{ $booking->phone }} <br>
                                                {{ $booking->address }}
                                            </p>
                                        </div>

                                        <div class="col-sm-4">
                                            <b>Công ty</b>
                                            <p>
                                                GOYA Travel <br>
                                                TP.HCM <br>
                                                0123456789
                                            </p>
                                        </div>

                                        <div class="col-sm-4">
                                            <b>Mã booking:</b> {{ $booking->bookingID }} <br>
                                            <b>Mã hóa đơn:</b> {{ $booking->mahoadon ?? '---' }} <br>
                                            <b>Ngày thanh toán:</b>
                                            {{ $booking->ngayTT ? date('d-m-Y', strtotime($booking->ngayTT)) : '---' }} <br>

                                            <b>Trạng thái:</b>
                                            @if($booking->trangthaiTT == 'paid')
                                                <span style="color:green;">Đã thanh toán</span>
                                            @else
                                                <span style="color:orange;">Chưa thanh toán</span>
                                            @endif
                                        </div>

                                    </div>

                                    {{-- TABLE --}}
                                    <div class="row">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Loại</th>
                                                    <th>Số lượng</th>
                                                    <th>Đơn giá</th>
                                                    <th>Thành tiền</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>Người lớn</td>
                                                    <td>{{ $booking->adult_count }}</td>
                                                    <td>{{ number_format($booking->gia_nguoiLon,0,',','.') }}</td>
                                                    <td>
                                                        {{ number_format($booking->gia_nguoiLon * $booking->adult_count,0,',','.') }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Trẻ em</td>
                                                    <td>{{ $booking->child_count }}</td>
                                                    <td>{{ number_format($booking->gia_emBe,0,',','.') }}</td>
                                                    <td>
                                                        {{ number_format($booking->gia_emBe * $booking->child_count,0,',','.') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- TOTAL --}}
                                    <div class="row">
                                        <div class="col-md-6"></div>

                                        <div class="col-md-6">
                                            <table class="table">
                                                <tr>
                                                    <th>Tổng tiền:</th>
                                                    <td style="color:red; font-weight:bold;">
                                                        {{ number_format($booking->tongtien ?? $booking->total_price,0,',','.') }} VNĐ
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                </section>
                            </div>
                        </div>

                        {{-- ACTION --}}
                        <div class="row no-print">
                            <button class="btn btn-default" onclick="window.print()">
                                In hóa đơn
                            </button>

                            @if($booking->status == 'pending')
                                <button class="btn btn-success btn-confirm"
                                        data-id="{{ $booking->bookingID }}">
                                    Xác nhận
                                </button>
                            @endif

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
```

</div>
@include('admin.blocks.footer')
