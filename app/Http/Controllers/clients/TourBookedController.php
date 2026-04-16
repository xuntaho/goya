<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TourBookedController extends Controller
{
    public function index()
    {
        $title = 'tour da dat';
        $userID = session('login_user_id');

        
        if (!$userID) {
            return redirect('/login')->with('error', 'Vui lòng đăng nhập');
        }

        $bookings = DB::table('booking')
            ->join('tours', 'booking.tourID', '=', 'tours.tourID')
            ->leftJoin('thanhtoan', 'booking.bookingID', '=', 'thanhtoan.bookingID')
            ->leftJoin('danhgia', function ($join) {
                    $join->on('booking.bookingID', '=', 'danhgia.bookingID');
                })
            ->where('booking.userID', $userID)
            ->select(
                'booking.username',
                'booking.email',
                'booking.phone',
                'booking.address',

                'booking.bookingID',
                'booking.tourID',
                'booking.adult_count',
                'booking.child_count',
                'booking.total_price',
                'booking.status',

                'tours.title',
                'tours.ngaybatdau',
                'tours.ngayketthuc',
                'tours.gia_nguoiLon',
                'tours.gia_emBe',

                'thanhtoan.pthucTT',

                'danhgia.id as review_id'
            )
            ->orderBy('booking.bookingID', 'desc')
            ->get();
        return view('clients.tour_booked', compact('title','bookings'));
    }

}
