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
        $count = $tours->count();
        $mien= $this->tours->getDomain();
        $mien_bac_count= optional($mien->firstWhere('mien', 'Bac'))->count;
        $mienCount = [
            'mien_bac' => optional($mien->firstWhere('mien', 'Bac'))->count,
            'mien_trung' => optional($mien->firstWhere('mien', 'Trung'))->count,
            'mien_nam' => optional($mien->firstWhere('mien', 'Nam'))->count,
            
        ];
        return view('clients.tours', compact('title', 'tours', 'count', 'mienCount'));
    }
    public function filterTours(Request $req)
    {
    $conditions = [];

    
    if ($req->filled('mien')) {
        $conditions[] = ['mien', '=', $req->mien];
    }

    if ($req->filled('thoigian')) {
        $conditions[] = ['thoigian', '=', $req->thoigian];
    }

    if ($req->filled('price')) {
        $cleanPrice = preg_replace('/[^0-9\-]/', '', $req->price);
        $priceRange = explode('-', $cleanPrice);

        if (count($priceRange) == 2) {
            $minPrice = (int)trim($priceRange[0]);
            $maxPrice = (int)trim($priceRange[1]);
            
            $conditions[] = ['gia_nguoiLon', '>=', $minPrice];
            $conditions[] = ['gia_nguoiLon', '<=', $maxPrice];
        }
    }
    $query = $this->tours->getTours($conditions);
    if ($req->filled('order')) {
        switch ($req->order) {
            case 'new':
                $query->orderBy('tourID', 'desc'); 
                break;
            case 'old':
                $query->orderBy('tourID', 'asc');
                break;
            case 'hight-to-low':
                $query->orderBy('gia_nguoiLon', 'desc');
                break;
            case 'low-to-high':
                $query->orderBy('gia_nguoiLon', 'asc');
                break;
            default:
                $query->orderBy('tourID', 'asc');
                break;
        }
    }
    $tours = $query->get();
    $count = $tours->count();
    return view('clients.partials.filter-tours', compact('tours', 'count'))->render();
}

        
}
