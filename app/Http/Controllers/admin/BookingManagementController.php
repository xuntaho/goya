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
            $booked = DB::table('booking')
                ->where('tourID', $booking->tourID)
                ->where('status', 'confirmed')
                ->sum(DB::raw('adult_count + child_count'));
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
                'message' => 'Lỗi hệ thống!'
            ], 500);
        }
    }
}