@include('admin.blocks.header')
<div class="container body">
    <div class="main_container">
        @include('admin.blocks.sidebar')

        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Sửa Tour</h3>
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

                            <div class="x_content add-tours">

                                <p>Cập nhật thông tin tour!</p>

                                <!-- FORM UPDATE -->
                                <form action="{{ route('admin.tours.update', $tour->tourID) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <!-- TÊN -->
                                    <div class="field item form-group">
                                        <label class="col-md-3">Tên</label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="title" value="{{ $tour->title }}"
                                                required>
                                        </div>
                                    </div>

                                    <!-- ĐIỂM ĐẾN -->
                                    <div class="field item form-group">
                                        <label class="col-md-3">Điểm đến</label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="diemden" value="{{ $tour->diemden }}"
                                                required>
                                        </div>
                                    </div>

                                    <!-- MIỀN -->
                                    <div class="field item form-group">
                                        <label class="col-md-3">Khu vực</label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="mien" required>
                                                <option value="">Chọn</option>
                                                <option value="Bac" {{ $tour->mien == 'Bac' ? 'selected' : '' }}>Miền Bắc
                                                </option>
                                                <option value="Trung" {{ $tour->mien == 'Trung' ? 'selected' : '' }}>Miền
                                                    Trung</option>
                                                <option value="Nam" {{ $tour->mien == 'Nam' ? 'selected' : '' }}>Miền Nam
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- SỐ CHỖ -->
                                    <div class="field item form-group">
                                        <label class="col-md-3">Số chỗ</label>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="socho"
                                                value="{{ $tour->socho }}" required>
                                        </div>
                                    </div>

                                    <!-- GIÁ -->
                                    <div class="field item form-group">
                                        <label class="col-md-3">Giá người lớn</label>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="gia_nguoiLon"
                                                value="{{ $tour->gia_nguoiLon }}" required>
                                        </div>
                                    </div>

                                    <div class="field item form-group">
                                        <label class="col-md-3">Giá trẻ em</label>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" name="gia_emBe"
                                                value="{{ $tour->gia_emBe }}" required>
                                        </div>
                                    </div>

                                    <!-- NGÀY -->
                                    <div class="field item form-group">
                                        <label class="col-md-3">Ngày bắt đầu</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control datetimepicker" name="ngaybatdau"
                                                id="start_date"
                                                value="{{ date('d-m-Y', strtotime($tour->ngaybatdau)) }}" required>
                                        </div>
                                    </div>

                                    <div class="field item form-group">
                                        <label class="col-md-3">Ngày kết thúc</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control datetimepicker" name="ngayketthuc"
                                                id="end_date"
                                                value="{{ date('d-m-Y', strtotime($tour->ngayketthuc)) }}" required>
                                        </div>
                                    </div>

                                    <!-- MÔ TẢ -->
                                    <div class="field item form-group">
                                        <label class="col-md-3">Mô tả</label>
                                        <div class="col-md-6">
                                            <textarea name="mota" class="form-control">{{ $tour->mota }}</textarea>
                                        </div>
                                    </div>

                                    <!-- ẢNH HIỆN TẠI -->
                                    <div class="field item form-group">
                                        <label class="col-md-3">Ảnh hiện tại</label>
                                        <div class="col-md-6">
                                            @if($tour->hinh)
                                                @if(Str::startsWith($tour->hinh, 'http'))
                                                    <img src="{{ $tour->hinh }}" width="80">
                                                @else
                                                    <img src="{{ asset('admin/assets/images/tours/' . $tour->hinh) }}"
                                                        width="80">
                                                @endif
                                            @else
                                                No Image
                                            @endif
                                        </div>
                                    </div>

                                    <!-- UPLOAD ẢNH MỚI -->
                                    <div class="field item form-group">
                                        <label class="col-md-3">Chọn ảnh mới</label>
                                        <div class="col-md-6">
                                            <input type="file" name="images[]" multiple class="form-control">
                                        </div>
                                    </div>

                                    <!-- TIMELINE -->
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
                                                Cập nhật Tour
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