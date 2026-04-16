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
            ->where('status', '!=', 'cancelled')
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
    return DB::table('tours')
        ->leftJoin('booking', 'tours.tourID', '=', 'booking.tourID')
        ->select(
            'tours.tourID',
            'tours.title',
            'tours.socho',
            DB::raw('COALESCE(SUM(booking.adult_count + booking.child_count),0) as booked_quantity'),
            DB::raw('(tours.socho - COALESCE(SUM(booking.adult_count + booking.child_count),0)) as available_slots')
        )
        ->groupBy('tours.tourID', 'tours.title', 'tours.socho')
        ->havingRaw('COALESCE(SUM(booking.adult_count + booking.child_count),0) > 0')
        ->orderByDesc('booked_quantity')
        ->take(3)
        ->get();
    }

    public function getNewBooking()
    {
        return DB::table('booking')
            ->join('tours', 'booking.tourID', '=', 'tours.tourID')
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