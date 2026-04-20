<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\BookingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                'message' => 'Đã xác nhận & thanh toán!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Lỗi xác nhận!'
            ], 500);
        }
    }

    public function cancelBooking(Request $request)
    {
        $bookingId = $request->bookingId;
        DB::beginTransaction();
        try {
            DB::table('booking')
                ->where('bookingID', $bookingId)
                ->update(['status' => 'cancelled']);

            DB::table('hoadon')
                ->where('bookingID', $bookingId)
                ->update(['trangthai' => 'cancelled']);

            DB::table('thanhtoan')
                ->where('bookingID', $bookingId)
                ->update(['trangthai' => 'failed']);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Đã hủy booking!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Hủy thất bại!'
            ], 500);
        }
    }

    public function showDetail($id)
    {
        $title = 'Chi tiết booking';
        $booking = DB::table('booking')
            ->join('tours', 'booking.tourID', '=', 'tours.tourID')
            ->join('hoadon', 'booking.bookingID', '=', 'hoadon.bookingID')
            ->join('thanhtoan', 'booking.bookingID', '=', 'thanhtoan.bookingID')
            ->where('booking.bookingID', $id)
            ->select(
                'booking.*',
                'tours.title as tour_name',
                'tours.gia_nguoiLon',
                'tours.gia_emBe',
                'hoadon.hoadonid as mahoadon',
                'hoadon.tongtien',
                'hoadon.trangthai as trangthaiTT',
                'hoadon.ngayTT',
                'thanhtoan.pthucTT',
                'thanhtoan.trangthai as payment_status'
            ) ->first();
        return view('admin.booking-detail', compact('booking', 'title'));
    }

    public function deleteBooking($id)
    {
        DB::beginTransaction();
        try {
            DB::table('hoadon')->where('bookingID', $id)->delete();
            DB::table('thanhtoan')->where('bookingID', $id)->delete();
            DB::table('booking')->where('bookingID', $id)->delete();
            DB::commit();
            return redirect('/admin/booking')
                ->with('success', 'Xóa thành công!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect('/admin/booking')
                ->with('error', 'Xóa thất bại!');
        }
    }
}