<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\DashboardModel;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private $dashboard;

    public function __construct()
    {
        $this->dashboard = new DashboardModel();
    }

   public function index()
    {
        $title = 'Admin Dashboard';
        if (session('role') !== 'admin') {
            return redirect()->route('login')->with('error', 'Bạn không có quyền truy cập!');
        }
        $summary = $this->dashboard->getSummary();
        $valueTour = $this->dashboard->getValueDomain();
        $dataDomain = [
            'values' => [
                $valueTour['Bac'] ?? 0,
                $valueTour['Trung'] ?? 0,
                $valueTour['Nam'] ?? 0,
            ]
        ];
        $paymentStatus = $this->dashboard->getValuePayment();
        $toursBooked = $this->dashboard->getMostTourBooked();
        $newBooking = $this->dashboard->getNewBooking();
        $revenue = $this->dashboard->getRevenuePerMonth();
        $totalUsers = DB::table('users')->count();
        
        return view('admin.dashboard', compact(
            'title',
            'summary',
            'dataDomain',
            'paymentStatus',
            'toursBooked',
            'newBooking',
            'revenue',
            'totalUsers'
        ));
    }
    public function bookingDetail($id)
    {
        $invoice_booking = DB::table('booking')
            ->join('tours', 'booking.tourID', '=', 'tours.tourID')
            ->leftJoin('thanhtoan', 'booking.bookingID', '=', 'thanhtoan.bookingID')
            ->select(
                'booking.*',
                'tours.title',
                'tours.diemden as destination',
                'tours.gia_nguoiLon as priceAdult',
                'tours.gia_emBe as priceChild',
                'thanhtoan.pthucTT as paymentMethod',
                'thanhtoan.ngaytt as paymentDate',
                'thanhtoan.magiaodich as transactionId',
                'thanhtoan.giatien as amount'
            )
            ->where('booking.bookingID', $id)
            ->first();

        return view('admin.booking-detail', compact('invoice_booking'));
    }
}