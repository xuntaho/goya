<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\clients\Tours;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ToursController extends Controller
{
    private $tours;
    public function __construct()
    {
        $this->tours =  new Tours();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Tours';
        $tours = $this->tours->getAllTours();
         $topTours = $this->tours->getTopTours();
        $count = $tours->count();
        $mien= $this->tours->getDomain();
        $mien_bac_count= optional($mien->firstWhere('mien', 'Bac'))->count;
        $mienCount = [
            'mien_bac' => optional($mien->firstWhere('mien', 'Bac'))->count,
            'mien_trung' => optional($mien->firstWhere('mien', 'Trung'))->count,
            'mien_nam' => optional($mien->firstWhere('mien', 'Nam'))->count,
            
        ];
        return view('clients.tours', compact('title', 'tours', 'count', 'mienCount', 'topTours', 'mien', 'mien_bac_count'));
    }
    public function filterTours(Request $req)
    {
        $query = DB::table('tours')
            ->where('tours.ngayketthuc', '>=', now())
            ->leftJoin('booking', 'tours.tourID', '=', 'booking.tourID')
            ->leftJoin('danhgia', 'tours.tourID', '=', 'danhgia.tourID')
            ->select(
                'tours.*',
                DB::raw('AVG(danhgia.sosao) as avg_rating'),
                DB::raw('COUNT(danhgia.id) as total_review'),
                DB::raw("
                    COALESCE(SUM(
                        CASE 
                            WHEN booking.status = 'confirmed' 
                            THEN booking.adult_count + booking.child_count 
                            ELSE 0 
                        END
                    ),0) as booked
                "),
                DB::raw("
                    (tours.socho - COALESCE(SUM(
                        CASE 
                            WHEN booking.status = 'confirmed' 
                            THEN booking.adult_count + booking.child_count 
                            ELSE 0 
                        END
                    ),0)) as conlai
                ")
            )
            ->groupBy(
                'tours.tourID',
                'tours.title',
                'tours.diemden',
                'tours.hinh',
                'tours.gia_nguoiLon',
                'tours.socho',
                'tours.ngaybatdau',
                'tours.ngayketthuc',
                'tours.thoigian',
                'tours.mien'
            );
        if (!empty($req->mien)) {
            $query->where('tours.mien', $req->mien);
        }
        if (!empty($req->thoigian)) {
            preg_match('/\d+/', $req->thoigian, $match);
            $days = isset($match[0]) ? (int)$match[0] : 0;

            if ($days > 0) {
                $query->whereRaw(
                    'DATEDIFF(tours.ngayketthuc, tours.ngaybatdau) + 1 = ?',
                    [$days]
                );
            }
        }
        if (!empty($req->price)) {

            $price = str_replace(['.', ','], '', $req->price);
            $range = explode('-', $price);

            if (count($range) == 2) {
                $min = (int)$range[0];
                $max = (int)$range[1];

                $query->whereBetween('tours.gia_nguoiLon', [$min, $max]);
            }
        }

        if (!empty($req->star)) {
            $star = (int)$req->star;

            if ($star == 5) {
                $query->having('avg_rating', '>=', 4.5);
            } else {
                $query->havingRaw('avg_rating >= ? AND avg_rating < ?', [$star, $star + 1]);
            }
        }
        if (!empty($req->order) && $req->order != 'default') {
            switch ($req->order) {
                case 'new':
                    $query->orderBy('tours.tourID', 'desc');
                    break;
                case 'old':
                    $query->orderBy('tours.tourID', 'asc');
                    break;
                case 'hight-to-low':
                    $query->orderBy('tours.gia_nguoiLon', 'desc');
                    break;
                case 'low-to-high':
                    $query->orderBy('tours.gia_nguoiLon', 'asc');
                    break;
            }
        }
        $tours = $query->get();
        $count = $tours->count();
        return view('clients.partials.filter-tours', compact('tours', 'count'))->render();
    }
        
}
