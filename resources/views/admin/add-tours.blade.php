@include('admin.blocks.header')
<div class="container body">
    <div class="main_container">
        @include('admin.blocks.sidebar')

        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Thêm Tours</h3>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Form</h2>
                                <div class="clearfix"></div>
                            </div>

                            <!-- ✅ FIX DIV -->
                            <div class="x_content add-tours">

                                <p>Thêm thông tin chi tiết để tạo một tour mới!</p>

                                <!-- ✅ 1 FORM DUY NHẤT -->
                                <form action="{{ route('admin.tours.add') }}" 
                                      method="POST" 
                                      enctype="multipart/form-data">
                                    @csrf

                                    <!-- THÔNG TIN -->
                                    <div class="field item form-group">
                                        <label class="col-md-3">Tên</label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="title" required>
                                        </div>
                                    </div>

                                    <div class="field item form-group">
                                        <label class="col-md-3">Điểm đến</label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="diemden" required>
                                        </div>
                                    </div>

                                    <div class="field item form-group">
                                        <label class="col-md-3">Khu vực</label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="mien" required>
                                                <option value="">Chọn</option>
                                                <option value="Bac">Miền Bắc</option>
                                                <option value="Trung">Miền Trung</option>
                                                <option value="Nam">Miền Nam</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="field item form-group">
                                        <label class="col-md-3">Số chỗ</label>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="socho" required>
                                        </div>
                                    </div>

                                    <div class="field item form-group">
                                        <label class="col-md-3">Giá người lớn</label>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="gia_nguoiLon" required>
                                        </div>
                                    </div>

                                    <div class="field item form-group">
                                        <label class="col-md-3">Giá trẻ em</label>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="gia_emBe" required>
                                        </div>
                                    </div>

                                    <div class="field item form-group">
                                        <label class="col-md-3">Ngày bắt đầu</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control datetimepicker" id="start_date" name="ngaybatdau" required>
                                        </div>
                                    </div>

                                    <div class="field item form-group">
                                        <label class="col-md-3">Ngày kết thúc</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control datetimepicker" id="end_date" name="ngayketthuc" required>
                                        </div>
                                    </div>

                                    <div class="field item form-group">
                                        <label class="col-md-3">Mô tả</label>
                                        <div class="col-md-6">
                                            <textarea name="mota" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- ✅ UPLOAD ẢNH (KHÔNG DROPZONE) -->
                                    <div class="field item form-group">
                                        <label class="col-md-3">Hình ảnh</label>
                                        <div class="col-md-6">
                                            <input type="file" name="images[]" multiple class="form-control">
                                        </div>
                                    </div>

                                    <!-- ✅ LỘ TRÌNH -->
                                    <div class="field item form-group">
                                        <label class="col-md-3">Lộ trình</label>
                                        <div class="col-md-6">
                                            <textarea name="timeline" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <!-- BUTTON -->
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <button type="submit" class="btn btn-success">
                                                Thêm Tour
                                            </button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <div class="pull-right">Admin</div>
            <div class="clearfix"></div>
        </footer>
    </div>
</div>
@include('admin.blocks.footer')