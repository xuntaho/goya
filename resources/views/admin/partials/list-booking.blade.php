@foreach($list_booking as $b)
<tr>

    <td>{{ $b->tour_name }}</td>
    <td>{{ $b->username }}</td>
    <td>{{ $b->email }}</td>
    <td>{{ $b->phone }}</td>
    <td>{{ $b->address }}</td>
    <td>
        {{ $b->booking_date ? date('d-m-Y', strtotime($b->booking_date)) : '' }}
    </td>
    <td>{{ $b->adult_count }}</td>
    <td>{{ $b->child_count }}</td>
    <td style="color:red; font-weight:bold;">
        {{ number_format($b->total_price, 0, ',', '.') }} VNĐ
    </td>
    <td>
        @if($b->status == 'pending')
            <span class="badge bg-warning">Chờ</span>
        @elseif($b->status == 'confirmed')
            <span class="badge bg-success">Đã xác nhận</span>
        @else
            <span class="badge bg-danger">Đã hủy</span>
        @endif
    </td>

    <td>
        <a href="{{ route('admin.booking.detail', $b->bookingID) }}"
       class="btn btn-info"
       style="padding:5px 10px; margin:2px;">
        👁
    </a>

        @if($b->status == 'pending')
            <button 
                class="btn btn-success btn-confirm"
                data-id="{{ $b->bookingID }}"
                title="Xác nhận"
            >
                ✔
            </button>
        @endif

        @if($b->status != 'cancelled')
            <button 
                class="btn btn-danger btn-cancel"
                data-id="{{ $b->bookingID }}"
                title="Hủy"
            >
                ✖
            </button>
        @endif

    </td>

</tr>
@endforeach
<style>
    .badge {
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 12px;
}

.bg-warning { background: orange; color: #fff; }
.bg-success { background: green; color: #fff; }
.bg-danger  { background: red; color: #fff; }

.btn-confirm, .btn-cancel {
    border: none;
    padding: 5px 10px;
    margin: 2px;
    cursor: pointer;
}
</style>