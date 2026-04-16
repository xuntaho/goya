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

        $result = $this->booking->updateBooking($bookingId, [
            'status' => 'confirmed'
        ]);

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Đã xác nhận booking!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Xác nhận thất bại!'
        ], 500);
    }

    public function cancelBooking(Request $request)
    {
        $bookingId = $request->bookingId;

        $result = $this->booking->updateBooking($bookingId, [
            'status' => 'cancelled'
        ]);

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Đã hủy booking!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Hủy thất bại!'
        ], 500);
    }

    public function showDetail($id)
    {   $title = 'Chi tiết booking';
        $booking = $this->booking->getBookingById($id);

        return view('admin.booking-detail', compact('booking', 'title'));
    }

    public function deleteBooking($id)
    {
        $result = DB::table('booking')
            ->where('bookingID', $id)
            ->delete();

        if ($result) {
            return redirect('/admin/booking')
                ->with('success', 'Xóa booking thành công!');
        }

        return redirect('/admin/booking')
            ->with('error', 'Xóa thất bại!');
    }
}