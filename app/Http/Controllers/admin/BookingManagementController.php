<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\BookingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class BookingManagementController extends Controller
{
    private $booking;

    public function __construct()
    {
        $this->booking = new BookingModel();
    }

    public function index(Request $request)
    {
        $title = 'Quản lý Booking';

        $keyword = $request->keyword;

        $list_booking = $this->booking->getBooking($keyword);

        return view('admin.booking', compact('title', 'list_booking', 'keyword'));
    }

    public function confirmBooking(Request $request)
    {
        $bookingId = $request->bookingId;

        DB::beginTransaction();

        try {
            $booking = DB::table('booking')
                ->where('bookingID', $bookingId)
                ->first();

            if (!$booking) {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking không tồn tại!'
                ], 404);
            }

            $tour = DB::table('tours')
                ->where('tourID', $booking->tourID)
                ->first();

            if (!$tour) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Tour không tồn tại!'
                ]);
            }

            $booked = DB::table('booking')
                ->where('tourID', $booking->tourID)
                ->where('status', 'confirmed')
                ->selectRaw('SUM(adult_count + child_count) as total')
                ->value('total') ?? 0;

            $current = $booking->adult_count + $booking->child_count;
            $conlai = $tour->socho - $booked;

            if ($current > $conlai) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Không đủ chỗ! Chỉ còn ' . $conlai . ' chỗ.'
                ], 400);
            }

            DB::table('booking')
                ->where('bookingID', $bookingId)
                ->update(['status' => 'confirmed']);

            DB::table('hoadon')
                ->where('bookingID', $bookingId)
                ->update(['trangthai' => 'paid']);

            DB::table('thanhtoan')
                ->where('bookingID', $bookingId)
                ->update(['trangthai' => 'paid']);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Xác nhận thành công!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage() 
            ]);
        }
    }
    public function cancelBooking(Request $request)
    {
        DB::beginTransaction();

        try {
            $booking = DB::table('booking')
                ->where('bookingID', $request->bookingID)
                ->first();

            if (!$booking) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy booking'
                ]);
            }

            DB::table('booking')
                ->where('bookingID', $request->bookingID)
                ->update([
                    'status' => 'cancelled'
                ]);

            DB::table('hoadon')
                ->where('bookingID', $request->bookingID)
                ->update([
                    'trangthai' => 'cancelled'
                ]);

   
            DB::table('thanhtoan')
                ->where('bookingID', $request->bookingID)
                ->update([
                    'trangthai' => 'failed'
                ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Đã hủy booking!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function showDetail($id)
    {
        $title = 'Chi tiết Booking';
        $booking = DB::table('booking')
            ->join('tours', 'booking.tourID', '=', 'tours.tourID')
            ->leftJoin('users', 'booking.userID', '=', 'users.userID')
            ->leftJoin('hoadon', 'booking.bookingID', '=', 'hoadon.bookingID')
            ->leftJoin('thanhtoan', 'booking.bookingID', '=', 'thanhtoan.bookingID')
            ->where('booking.bookingID', $id)
            ->select(
                'booking.*',
                'tours.title as tour_name',
                'tours.gia_nguoiLon',
                'tours.gia_emBe',
                'tours.ngaybatdau as startDate', 
                'tours.diemden as destination',
                'users.username',
                'users.email',
                'hoadon.mahoadon',
                'thanhtoan.magd',
                'thanhtoan.trangthai as trangthaiTT',
                'thanhtoan.ngayTT',
                'thanhtoan.pthucTT',

                DB::raw('(booking.adult_count * tours.gia_nguoiLon + booking.child_count * tours.gia_emBe) as original_price')
            )
            ->first();

        if (!$booking) {
            return redirect()->route('admin.booking')
                ->with('error', 'Không tìm thấy booking');
        }

        return view('admin.booking-detail', compact('booking', 'title'));
    }
    public function sendPdf(Request $request)
    {
        $bookingId = $request->input('bookingId');

        $booking = DB::table('booking')
            ->join('tours', 'booking.tourID', '=', 'tours.tourID')
            ->leftJoin('users', 'booking.userID', '=', 'users.userID')
            ->leftJoin('hoadon', 'booking.bookingID', '=', 'hoadon.bookingID')
            ->leftJoin('thanhtoan', 'booking.bookingID', '=', 'thanhtoan.bookingID')
            ->leftJoin('khuyenmai', 'booking.kmID', '=', 'khuyenmai.kmID')
            ->where('booking.bookingID', $bookingId)
            ->select(
                'booking.*',
                'tours.title as tour_name',
                'tours.gia_nguoiLon',
                'tours.gia_emBe',
                'users.username',
                'users.email',
                'users.phone',
                'users.address',
                'hoadon.mahoadon',
                'thanhtoan.magd',
                'thanhtoan.ngayTT',
                'thanhtoan.pthucTT',
                DB::raw('(booking.adult_count * tours.gia_nguoiLon + booking.child_count * tours.gia_emBe) as total_price')
            )
            ->first();

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy booking'
            ]);
        }
        if (!$booking->magd) {
            $booking->magd = 'Thanh toán tại văn phòng';
        }

        try {
            Mail::send('admin.emails.invoice', compact('booking'), function ($message) use ($booking) {
                $message->to($booking->email)
                    ->subject('Hóa đơn đặt tour - ' . $booking->username);
            });

            return response()->json([
                'success' => true,
                'message' => 'Đã gửi hóa đơn qua email!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi gửi mail: ' . $e->getMessage()
            ], 500);
        }
    }
    public function receiviedMoney(Request $request)
    {
        $bookingId = $request->bookingId;

        $result = DB::table('thanhtoan')
            ->where('bookingID', $bookingId)
            ->update([
                'trangthai' => 'paid'
            ]);

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Đã xác nhận thanh toán!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cập nhật thất bại'
            ], 500);
        }
    }
    

}