<form method="GET">
    <h2>Danh sách tours</h2>
    <div class="input-group" style="display:flex; gap:10px; align-items:center;">

        <input type="text" name="keyword" class="form-control"
            style="max-width:200px;"
            placeholder="Tìm tour..."
            value="{{ $keyword ?? '' }}">

        <select name="mien" class="form-control" style="max-width:150px;">
            <option value="">Miền</option>
            <option value="Bac" {{ ($mien ?? '') == 'Bac' ? 'selected' : '' }}>Bắc</option>
            <option value="Trung" {{ ($mien ?? '') == 'Trung' ? 'selected' : '' }}>Trung</option>
            <option value="Nam" {{ ($mien ?? '') == 'Nam' ? 'selected' : '' }}>Nam</option>
        </select>

        <select name="price" class="form-control" style="max-width:180px;">
            <option value="">Giá</option>
            <option value="1" {{ ($price ?? '') == '1' ? 'selected' : '' }}>Dưới 2tr</option>
            <option value="2" {{ ($price ?? '') == '2' ? 'selected' : '' }}>2-5tr</option>
            <option value="3" {{ ($price ?? '') == '3' ? 'selected' : '' }}>>5tr</option>
        </select>

        <button class="btn btn-primary">Lọc</button>

    </div>
</form>

<div style="overflow-x:auto;">

<table class="table table-bordered table-hover">
    
    <thead>
        <tr>
            <th>TourID</th>
            <th>Ảnh</th>
            <th>Tên</th>
            <th>Mô tả</th>
            <th>Số chỗ</th>
            <th>Còn lại</th>
            <th>Giá NL</th>
            <th>Giá TE</th>
            <th>Điểm đến</th>
            <th>Miền</th>
            <th>Thời gian</th>
            <th>Ngày BĐ</th>
            <th>Ngày KT</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>

    <tbody>
    @foreach ($tours as $tour)
        <tr>

            <td>{{ $tour->tourID }}</td>
            <td>
            @if($tour->hinh)
                @if(Str::startsWith($tour->hinh, 'http'))
                    <img src="{{ $tour->hinh }}" width="80">
                @else
                    <img src="{{ asset('admin/assets/images/tours/'.$tour->hinh) }}" width="80">
                @endif
            @else
                No Image
            @endif
            </td>

            <td>{{ $tour->title }}</td>

            <td style="max-width:250px;">
                {{ \Illuminate\Support\Str::limit(strip_tags($tour->mota), 30, '...') }}
            </td>

            <td>{{ $tour->socho }}</td>
            <td>
                @if(($tour->conlai ?? $tour->socho) <= 0)
                    <span style="color:red;">0 (Hết chỗ)</span>
                @else
                    <span style="color:green;">
                        {{ $tour->conlai ?? $tour->socho }}
                    </span>
                @endif
            </td>

            <td style="color:red;">
                {{ number_format($tour->gia_nguoiLon, 0, ',', '.') }}
            </td>

            <td>
                {{ number_format($tour->gia_emBe, 0, ',', '.') }}
            </td>

            <td>{{ $tour->diemden }}</td>

            <td>{{ $tour->mien }}</td>

            @php
                $start = \Carbon\Carbon::parse($tour->ngaybatdau);
                $end = \Carbon\Carbon::parse($tour->ngayketthuc);

                $days = $start->diffInDays($end) + 1;
                $nights = $days - 1;
            @endphp

            <td>{{ $days }}N{{ $nights }}Đ</td>

            <td>
                {{ $tour->ngaybatdau ? date('d-m-Y', strtotime($tour->ngaybatdau)) : '' }}
            </td>

            <td>
                {{ $tour->ngayketthuc ? date('d-m-Y', strtotime($tour->ngayketthuc)) : '' }}
            </td>
@php
    $today = \Carbon\Carbon::now();
    $end = \Carbon\Carbon::parse($tour->ngayketthuc);
@endphp

<td>
    @if(!$tour->tinhkhadung)
        <span style="color:orange;">Ẩn</span>
    @elseif($end < $today)
        <span style="color:red;">Hết hạn</span>
    @else
        <span style="color:green;">Hiển thị</span>
    @endif
</td>
            <td>

                <a href="{{ route('admin.tours.edit', $tour->tourID) }}">
                    <span class="glyphicon glyphicon-edit" style="color:#26B99A; font-size:18px"></span>
                </a>
                <form action="{{ route('admin.tours.delete', $tour->tourID) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="delete-tour" onclick="return confirm('Xóa tour này?')" style="border:none;background:none;">
                        <span class="glyphicon glyphicon-trash" style="color:red; font-size:18px"></span>
                    </button>
                </form>

            </td>

        </tr>
    @endforeach
    </tbody>

</table>

</div>

{{-- CSS --}}
<style>
.table {
    table-layout: fixed;
    width: 100%;
}

.table th {
    background: #f5f5f5;
    text-align: center;
}

.table td {
    word-wrap: break-word;
    vertical-align: middle;
    text-align: center;
}

/* cột mô tả */
.table td:nth-child(4) {
    max-width: 250px;
    overflow: hidden;
}

/* ảnh */
.table img {
    border-radius: 6px;
}
</style>