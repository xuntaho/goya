<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DashboardModel extends Model
{
    use HasFactory;

    public function getSummary()
    {
        $tourWorking = DB::table('tours')
            ->where('tinhkhadung', 1)
            ->count();
        $countBooking = DB::table('booking')
            ->where('status', 'confirmed')
            ->count();
       $totalAmount = DB::table('thanhtoan')
            ->where('trangthai', 'paid')
            ->sum('giatien');
        return [
            'tourWorking' => $tourWorking,
            'countBooking' => $countBooking,
            'totalAmount' => $totalAmount,
        ];
    }
    public function getValueDomain()
    {
        return DB::table('tours')
            ->select(DB::raw('mien, COUNT(*) as count'))
            ->whereIn('mien', ['Bac', 'Trung', 'Nam'])  
            ->groupBy('mien')  
            ->get()
            ->pluck('count', 'mien');  
    }
        public function getValuePayment()
    {
        return DB::table('hoadon')
            ->select('trangthai', DB::raw('COUNT(*) as total'))
            ->groupBy('trangthai')
            ->get();
    }   
    public function getMostTourBooked()
    {
        $sub = DB::table('booking')
            ->select(
                'tourID',
                DB::raw('CAST(SUM(adult_count + child_count) AS UNSIGNED) as booked')
            )
            ->where('status', '=', 'confirmed') 
            ->groupBy('tourID');

        return DB::table('tours')
            ->joinSub($sub, 'b', function ($join) {
                $join->on('tours.tourID', '=', 'b.tourID');
            })
            ->select(
                'tours.tourID',
                'tours.title',
                'tours.socho',
                'b.booked as booked_quantity',
                DB::raw('(tours.socho - b.booked) as available_slots')
            )
            ->where('b.booked', '>', 0)
            ->orderByDesc('booked_quantity')
            ->limit(4)
            ->get();
    }

    public function getNewBooking()
    {
        return DB::table('booking')
            ->join('tours', 'booking.tourID', '=', 'tours.tourID')
            ->where('booking.status', '!=', 'cancelled')
            ->select(
                'booking.bookingID',
                'booking.username',
                'booking.total_price',
                'booking.status',
                'tours.title as tour_name'
            )
            ->orderByDesc('booking.bookingID')
            ->limit(5)
            ->get();
    }
   public function getRevenuePerMonth()
    {
        $monthlyRevenue = DB::table('booking')
            ->select(DB::raw('MONTH(booking_date) as month, SUM(total_price) as revenue'))
            ->where('status', 'confirmed')
            ->whereYear('booking_date', date('Y')) // Thêm lọc theo năm hiện tại
            ->groupBy(DB::raw('MONTH(booking_date)'))
            ->orderBy('month', 'asc')
            ->get();

        $revenueData = array_fill(0, 12, 0); 
        foreach ($monthlyRevenue as $data) {
            $revenueData[$data->month - 1] = $data->revenue; 
        }
        return $revenueData;
    }
}