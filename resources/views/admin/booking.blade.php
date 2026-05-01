@include('admin.blocks.header')

<div class="container body">
    <div class="main_container">
        @include('admin.blocks.sidebar')

        <div class="right_col" role="main">
            <div class="">
                <div class="title_right">
                        <div class="col-md-5 col-sm-5 form-group pull-right top_search">

                            <form method="GET" action="">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm..."
                                        value="{{ request('keyword') }}">

                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit">Go!</button>
                                    </span>
                                </div>
                            </form>

                        </div>
                    </div>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">

                            <div class="x_title">
                                <h2>Danh sách Booking</h2>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">

                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tour</th>
                                            <th>Khách</th>
                                            <th>Email</th>
                                            <th>SĐT</th>
                                            <th>Ngày đặt</th>
                                            <th>Người lớn</th>
                                            <th>Trẻ em</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach($list_booking as $b)
                                            <tr>

                                                <td>{{ $b->tour_name }}</td>
                                                <td>{{ $b->username }}</td>
                                                <td>{{ $b->email }}</td>
                                                <td>{{ $b->phone }}</td>

                                                <td>
                                                    {{ $b->booking_date ? date('d-m-Y', strtotime($b->booking_date)) : '' }}
                                                </td>

                                                <td>{{ $b->adult_count }}</td>
                                                <td>{{ $b->child_count }}</td>

                                                <td style="color:red;">
                                                    {{ number_format($b->total_price, 0, ',', '.') }} đ
                                                </td>

                                                <td>
                                                    @if($b->status == 'pending')
                                                        <span style="color:orange;">Chờ</span>
                                                    @elseif($b->status == 'confirmed')
                                                        <span style="color:green;">Đã xác nhận</span>
                                                    @else
                                                        <span style="color:red;">Đã hủy</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('admin.booking.detail', $b->bookingID) }}"
                                                        class="btn btn-info btn-sm">
                                                        👁
                                                    </a>
                                                    @if($b->status == 'pending')
                                                        <button class="btn btn-success btn-sm btn-confirm"
                                                            data-id="{{ $b->bookingID }}"
                                                            data-url="{{ route('admin.confirm-booking') }}">
                                                            ✔
                                                        </button>
                                                        
                                                    @endif
                                                    @if($b->status != 'cancelled')
                                                        <button type="button" class="btn btn-danger btn-sm btn-cancel"
                                                            data-id="{{ $b->bookingID }}">
                                                            ✖
                                                        </button>
                                                    @endif

                                                

                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

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