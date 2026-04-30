@include('admin.blocks.header')

<div class="container body">
    <div class="main_container">

        @include('admin.blocks.sidebar')

        <div class="right_col" role="main">
            <div class="">

                <div class="page-title">
                    <div class="title_left">
                        <h2>Sửa Khuyến Mãi</h2>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">

                            

                            <div class="x_content">

                                <form action="{{ route('admin.khuyenmai.update', $km->kmID) }}" method="POST" id="form-km-edit">
                                    @csrf
                                    <div class="form-group">
                                        <label>Loại</label>
                                        <input class="form-control"
                                            value="{{ $km->tourID ? 'Auto (Theo tour)' : 'Coupon (Mã code)' }}"
                                            disabled>
                                    </div>

                                    <div class="form-group">
                                        <label>Tour</label>
                                        <input class="form-control"
                                            value="{{ $km->title ?? 'Không áp dụng tour cụ thể' }}"
                                            disabled>
                                    </div>

                                    <div class="form-group">
                                        <label>Mã giảm giá</label>
                                        <input class="form-control"
                                            name="code"
                                            value="{{ $km->code }}"
                                            {{ $km->tourID ? 'disabled' : '' }}>
                                    </div>

                                    <div class="form-group">
                                        <label>Giảm giá</label>
                                        <input type="number" class="form-control"
                                            name="discount"
                                            value="{{ $km->discount }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Kiểu giảm</label>
                                        <select name="type" class="form-control">
                                            <option value="percent" {{ $km->type == 'percent' ? 'selected' : '' }}>
                                                %
                                            </option>
                                            <option value="fixed" {{ $km->type == 'fixed' ? 'selected' : '' }}>
                                                VNĐ
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Số lượng</label>
                                        <input type="number" class="form-control"
                                            name="soluong"
                                            value="{{ $km->soluong }}">
                                    </div>

                                    <div class=" form-group">
                                        <label class="col-md-1" >Ngày bắt đầu</label>
                                            <input type="text" class="form-control datetimepicker" name="ngaybatdau"
                                                id="start_date"
                                                value="{{ date('d-m-Y', strtotime($km->ngaybatdau)) }}" required>
                                
                                    </div>
                                    <div class=" form-group">
                                        <label >Ngày kết thúc</label>
                                            <input type="text" class="form-control datetimepicker" name="ngayketthuc"
                                                id="end_date"
                                                value="{{ date('d-m-Y', strtotime($km->ngayketthuc)) }}" required>      
                                    </div>

                                    <div class="form-group">
                                        <label>Trạng thái</label>
                                        <select name="trangthai" class="form-control">
                                            <option value="active" {{ $km->trangthai == 'active' ? 'selected' : '' }}>
                                                Hoạt động
                                            </option>
                                            <option value="disabled" {{ $km->trangthai == 'disabled' ? 'selected' : '' }}>
                                                Tắt
                                            </option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-success">
                                        Cập nhật
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>
@include('admin.blocks.footer')