<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookingModel extends Model
{
    protected $table = 'booking';
    public function getBooking($keyword = null)
    {
        $query = DB::table('booking')
            ->join('tours', 'booking.tourID', '=', 'tours.tourID')
            ->select(
                'booking.*',
                'tours.title as tour_name'
            );

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {

                if (is_numeric($keyword)) {
                    $q->where('booking.bookingID', $keyword);
                }
                $q->orWhere('booking.username', 'like', '%' . $keyword . '%')
                ->orWhere('booking.email', 'like', '%' . $keyword . '%')
                ->orWhere('booking.phone', 'like', '%' . $keyword . '%')
                ->orWhere('tours.title', 'like', '%' . $keyword . '%')
                ->orWhere('booking.status', 'like', '%' . $keyword . '%');
            });
        }
        return $query->orderBy('booking.created_at', 'desc')->get();
    }
    public function getBookingById($id)
    {
        return DB::table('booking')
            ->join('tours', 'booking.tourID', '=', 'tours.tourID')
            ->leftJoin('hoadon', 'booking.bookingID', '=', 'hoadon.bookingID')
            ->select(
                'booking.*',
                'tours.title as tour_name',
                'tours.gia_nguoiLon',
                'tours.gia_emBe',
                'tours.diemden', 
                'hoadon.tongtien',
                'hoadon.ngayTT',
                'hoadon.trangthai as trangthaiTT',
                'hoadon.mahoadon'
            )
            ->where('booking.bookingID', $id)
            ->first();
    }
    public function updateBooking($bookingId, $data)
    {
        return DB::table('booking')
            ->where('bookingID', $bookingId)
            ->update($data);
    }
    
}