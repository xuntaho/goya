@include('admin.blocks.header')

<div class="container body">
    <div class="main_container">

        @include('admin.blocks.sidebar')

        <div class="right_col" role="main">
            <div class="">

                <div class="page-title">
                    <div class="title_left">
                        <h2>Thêm Khuyến Mãi</h2>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">

                            <div class="x_title">
                                <h2>Form</h2>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">



                                <form action="{{ route('admin.khuyenmai.store') }}" method="POST" id="form-km-create">
                                    @csrf

                                    <div class="field item form-group">
                                        <label class="col-md-3">Loại khuyến mãi</label>
                                        <div class="col-md-6">
                                            <select name="type_km" id="type_km" class="form-control" required>
                                                <option value="">Chọn loại</option>
                                                <option value="auto">Theo Tour</option>
                                                <option value="coupon">Mã giảm giá</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="field item form-group" id="tour_box" style="display:none;" >
                                        <label class="col-md-3">Tour</label>
                                        <div class="col-md-6">
                                            <select name="tourID" class="form-control">
                                                <option value="">Chọn tour</option>
                                                @foreach($tours as $t)
                                                    <option value="{{ $t->tourID }}">{{ $t->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="field item form-group" style="margin-top:20px;">
                                        <label class="col-md-3">Tên khuyến mãi</label>
                                        <div class="col-md-6">
                                            <input type="text" name="tenKM" class="form-control" required>
                                        </div>
                                    </div>
                                     <div class="clearfix"></div>

                                   <div class="field item form-group" id="code_box" style="margin-top:20px;">
                                        <label class="col-md-3">Mã giảm giá</label>
                                        <div class="col-md-6">
                                            <input type="text" name="code" class="form-control">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    
                                    <div class="field item form-group" style="margin-top:20px;">
                                        <label class="col-md-3">Giảm giá</label>
                                        <div class="col-md-6">
                                            <input type="number" name="discount" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="field item form-group">
                                        <label class="col-md-3">Kiểu giảm</label>
                                        <div class="col-md-6">
                                            <select name="type" class="form-control">
                                                <option value="percent">%</option>
                                                <option value="fixed">VNĐ</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="field item form-group">
                                        <label class="col-md-3">Số lượng</label>
                                        <div class="col-md-6">
                                            <input type="number" name="soluong" class="form-control">
                                        </div>
                                    </div>

                                    <div class="field item form-group">
                                        <label class="col-md-3">Ngày bắt đầu</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control datetimepicker" name="ngaybatdau"
                                                id="start_date"
                                                value="{{ date('d-m-Y') }}" required>
                                        </div>
                                    </div>
                                    <div class="field item form-group">
                                        <label class="col-md-3">Ngày kết thúc</label>
                                        <div class="col-md-6">
                                             <input type="text" class="form-control datetimepicker" name="ngayketthuc"
                                                id="end_date"
                                                value="{{ date('d-m-Y') }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <button class="btn btn-success">
                                                Thêm Khuyến Mãi
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
    </div>
</div>
<script>
    document.getElementById('type_km').addEventListener('change', function () {
        let type = this.value;

        let tourBox = document.getElementById('tour_box');
        let codeBox = document.getElementById('code_box');

        if (type === 'auto') {
            tourBox.style.display = 'block';
            codeBox.style.display = 'none';
        } else if (type === 'coupon') {
            tourBox.style.display = 'block';
            codeBox.style.display = 'block';
        } else {
            tourBox.style.display = 'none';
            codeBox.style.display = 'none';
        }
        
    });
  
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    
</script>

@include('admin.blocks.footer')
