<h2>Danh sách khuyến mãi</h2>

<div style="overflow-x:auto;">
<table class="table table-bordered table-hover">

    <thead>
        <tr>
            <th>ID</th>
            <th>Loại</th>
            <th>Tour</th>
            <th>Code</th>
            <th>Giảm</th>
            <th>Kiểu</th>
            <th>Số lượng</th>
            <th>Hạn</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>

    <tbody>
    @foreach($list as $km)
        <tr>
            <td>{{ $km->kmID }}</td>

            <td>
                @if($km->code)
                    <span style="color:orange;">Coupon</span>
                @else
                    <span style="color:blue;">Auto</span>
                @endif
            </td>

            <td> {{ $km->tourID }} - {{ $km->title }}</td>

            <td>
                @if($km->code)
                    <span style="color:green; font-weight:bold;">
                        {{ $km->code }}
                    </span>
                @else
                    -
                @endif
            </td>

            <td style="color:red;">
                @if($km->type == 'percent')
                    {{ $km->discount }} %
                @else
                    {{ number_format($km->discount,0,',','.') }} đ
                @endif
            </td>

            <td>
                {{ $km->type == 'percent' ? 'Phần trăm' : 'Tiền' }}
            </td>

            <td>
                @if($km->soluong > 0)
                    <span style="color:green;">{{ $km->soluong }}</span>
                @else
                    <span style="color:red;">Hết</span>
                @endif
            </td>

            <td>
                {{ $km->ngaybatdau }} <br> → {{ $km->ngayketthuc }}
            </td>

            <td>
                @php
                    $today = now();
                @endphp

                @if($km->trangthai == 'disabled')
                    <span style="color:gray;">Tắt</span>
                @elseif($km->ngayketthuc < $today)
                    <span style="color:red;">Hết hạn</span>
                @else
                    <span style="color:green;">Hoạt động</span>
                @endif
            </td>

            <td>

                <a href="{{ route('admin.khuyenmai.edit', $km->kmID) }}">
                    <span class="glyphicon glyphicon-edit" style="color:#26B99A; font-size:18px"></span>
                </a>
                <form action="{{ route('admin.khuyenmai.delete', $km->kmID) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="delete-km" onclick="return confirm('Xóa khuyến mãi này?')" style="border:none;background:none;">
                        <span class="glyphicon glyphicon-trash" style="color:red; font-size:18px"></span>
                    </button>
                    
                </form>

            </td>
        </tr>
    @endforeach
    </tbody>

</table>
</div>
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
</style>