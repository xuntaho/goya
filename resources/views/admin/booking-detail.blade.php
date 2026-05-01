@include('admin.blocks.header')
<div class="container body">
    <div class="main_container">
        @include('admin.blocks.sidebar')
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Hóa đơn <small>đặt tour du lịch</small></h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="invoice_booking">
                                <div class="x_title">
                                    <h2>Hóa đơn chi tiết</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <section class="content invoice">
                                        <!-- title row -->
                                        <div class="row">
                                            <div class="  invoice-header">
                                                <h3>
                                                    <img src="{{ asset('admin/assets/images/icon/icon_office.png') }}"
                                                        alt="" style="margin-right: 10px">{{ $booking->tour_name }}
                                                    <small class="pull-right">Ngày:
                                                        {{ date('d-m-Y', strtotime($booking->booking_date)) }}</small>
                                                </h3>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- info row -->
                                        <div class="row invoice-info">
                                            <div class="col-sm-4 invoice-col">
                                                Từ
                                                <address>
                                                    <strong>{{ $booking->username }}</strong>
                                                    <br>{{ $booking->address }}
                                                    <br>Số điện thoại: {{ $booking->phone }}
                                                    <br>Email:{{ $booking->email }}
                                                </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                Đến
                                                <address>
                                                    <strong>Công ty Goya</strong>
                                                    <br>180 Cao Lỗ, P.4
                                                    <br>Quận 8, TP.HCM
                                                    <br>Sdt: +880 (123) 345 88
                                                    <br>Email: xuanthao0214@gmail.com
                                                </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                <b>Mã hóa đơn #{{ $booking->mahoadon }}</b>
                                                <br>
                                                <b>Mã giao dịch:</b> {{ $booking->magd }}
                                                <br>
                                                <b>Ngày thanh toán:</b> {{ $booking->ngayTT ? date('d-m-Y', strtotime($booking->ngayTT)) : '---' }}
                                                <br>
                                                <b>Email:</b> {{ $booking->email }}
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- Table row -->
                                        <div class="row">
                                            <div class="  table">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Số lượng</th>
                                                            <th>Đơn giá</th>
                                                            <th>Điểm đến</th>
                                                            <th>Tổng tiền</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Người lớn</td>
                                                            <td>{{ $booking->adult_count }}</td>
                                                            <td>{{ number_format($booking->gia_nguoiLon, 0, ',', '.') }}
                                                                vnđ</td>
                                                            <td>{{ $booking->tour_name }}</td>
                                                            <td>{{ number_format($booking->gia_nguoiLon * $booking->adult_count, 0, ',', '.') }}
                                                                vnđ</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Trẻ em</td>
                                                            <td>{{ $booking->child_count }}</td>
                                                            <td>{{ number_format($booking->gia_emBe, 0, ',', '.') }}
                                                                vnđ</td>
                                                            <td>{{ $booking->tour_name }}</td>
                                                            <td>{{ number_format($booking->gia_emBe * $booking->child_count, 0, ',', '.') }}
                                                                vnđ</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <div class="row">

                                            <div class="col-md-6">
                                                <p class="lead">Phương thức thanh toán:</p>

                                                @if ($booking->pthucTT == 'momo')
                                                    <img src="{{ asset('admin/assets/images/icon/icon_momo.png') }}"
                                                        class="invoice_payment-method" alt="Momo">
                                                         <span class="badge" style="background:#d82d8b; color:#fff;">
                                                            Ví điện tử MoMo
                                                        </span>

                                                @elseif ($booking->pthucTT == 'bank')
                                                    <img src="{{ asset('admin/assets/images/icon/icon_paypal.png') }}"
                                                        class="invoice_payment-method" alt="Bank">
                                                    <span class="badge badge-primary">Chuyển khoản</span>

                                                @elseif ($booking->pthucTT == 'cash')
                                                    <img src="{{ asset('admin/assets/images/icon/icon_office.png') }}"
                                                        class="invoice_payment-method" alt="Cash">
                                                    <span class="badge badge-success">Thanh toán trực tiếp tại văn phòng</span>

                                                @else
                                                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                                        Vui lòng hoàn tất thanh toán theo hướng dẫn hoặc liên hệ với chúng
                                                        tôi nếu cần hỗ trợ.
                                                    </p>
                                                @endif

                                            </div>

                                            <div class="col-md-6">
                                                <p class="lead">Số tiền phải trả trước
                                                    {{ isset($booking->startDate) ? date('d-m-Y', strtotime($booking->startDate)) : '---' }}
                                                </p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>

                                                            @php
                                                                $giaGoc = $booking->original_price;
                                                                $tongThanhToan = $booking->total_price;
                                                                $giam = $giaGoc - $tongThanhToan;
                                                                $percent = $giaGoc > 0 ? round(($giam / $giaGoc) * 100) : 0;
                                                            @endphp
                                                            <tr>
                                                                <th>Tổng tiền</th>
                                                                <td>{{ number_format($giaGoc) }} vnđ</td>
                                                            </tr>
                                                            @if($giam > 0)
                                                                <tr>
                                                                    <th>Giảm giá</th>
                                                                    <td style="color:red;">
                                                                        -{{ number_format($giam) }} vnđ ({{ $percent }}%)
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                            <tr>
                                                            <tr>
                                                                <th style="font-size:18px;">Tổng thanh toán</th>
                                                                <td
                                                                    style="font-size:20px; color:#e74c3c; font-weight:bold;">
                                                                    {{ number_format($tongThanhToan) }} vnđ
                                                                </td>
                                                            </tr>

                                                            </tr>


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                    </section>
                                </div>
                            </div>

                            <div class="row no-print">
                                <div class=" ">
                                    <button class="btn btn-default" onclick="window.print();"><i
                                            class="fa fa-print"></i> Print</button>

                                    @if ($booking->status == 'pending')
                                        <button class="btn btn-success confirm-booking"
                                            data-bookingid="{{ $booking->bookingID }}"
                                            data-url="{{ route('admin.confirm-booking') }}">
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
        <!-- /page content -->
    </div>
</div>
@include('admin.blocks.footer')