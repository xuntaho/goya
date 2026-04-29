<?php

namespace App\Models\clients;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Tours extends Model
{
    protected $table = 'tours';
    public function getAllTours()
    {
       return DB::table('tours')->where('tours.ngayketthuc', '>=', now())
            ->leftJoin('booking', 'tours.tourID', '=', 'booking.tourID')
            ->leftJoin('danhgia', 'tours.tourID', '=', 'danhgia.tourID')
            ->select(
                'tours.*',
                DB::raw('AVG(danhgia.sosao) as avg_rating'),
                DB::raw('COUNT(danhgia.id) as total_review'),
                DB::raw('COALESCE(SUM(booking.adult_count + booking.child_count),0) as booked'),
                DB::raw('(tours.socho - COALESCE(SUM(booking.adult_count + booking.child_count),0)) as conlai')

            )
            ->groupBy('tours.tourID')
            ->get();
    }
    public function getchitiet_tour($id)
    {
           $getchitiet_tour = DB::table($this->table)
            ->where('tourID', $id) 
            ->first();
        if ($getchitiet_tour) {
            $getchitiet_tour->images = DB::table('image')
                ->where('tourID', $getchitiet_tour->tourID) 
                ->pluck('imgurl')
                ->toArray();
            $getchitiet_tour->timeline = DB::table('timeline')
                ->where('tourID', $getchitiet_tour->tourID)
                ->get();
                
        }
            return $getchitiet_tour;
    }
    function getDomain() {
        return DB::table($this->table)
        ->select('mien', DB::raw('COUNT(*) as count'))
        ->whereIn('mien', ['Bac', 'Trung', 'Nam'])
        -> groupBy('mien')
        ->get();
    }
    public function getTours($filters = [], $sorting = null) {
    $query = DB::table($this->table)->where('ngayketthuc', '>=', now());
    
    if (!empty($filters)) {
        $query->where($filters);
    }
    
    if ($sorting) {
        $query->orderByRaw($sorting);
    }
    
    return $query; 
    }
    public function getTourById($id)
    {
    return DB::table($this->table)
        ->where('tourID', $id)
        ->first();
    }
     public function getHotDeals()
    {
        return DB::table('tours')
            ->join('khuyenmai', 'tours.tourID', '=', 'khuyenmai.tourID')
            ->select('tours.*', 'khuyenmai.discount', 'khuyenmai.type')
            ->get();
    }
    public function getTopTours()
    {
        return DB::table('booking')
            ->join('tours', 'booking.tourID', '=', 'tours.tourID')
            ->leftJoin('danhgia', 'tours.tourID', '=', 'danhgia.tourID')

            ->select(
                'tours.tourID',
                'tours.title',
                'tours.diemden',
                'tours.hinh',
                DB::raw('COUNT(booking.bookingID) as total_booked'),
                DB::raw('AVG(danhgia.sosao) as avg_rating'),
                DB::raw('COUNT(danhgia.id) as total_review')
            )
            ->groupBy(
                'tours.tourID',
                'tours.title',
                'tours.diemden',
                'tours.hinh'
            )
            ->orderByDesc('total_booked')
            ->limit(3)
            ->get();
    }
}
