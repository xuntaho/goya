<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Tours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChiTietToursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $tour;
    public function __construct()
    {
       $this->tour = new Tours();
    }
    public function index($id=0)
    {
        $title = 'Chi tiết tour';
    $chitiet_tour = $this->tour->getchitiet_tour($id);
    $bookingID = request()->query('bookingID');
    $getReviews = DB::table('danhgia')
        ->join('users', 'danhgia.userID', '=', 'users.userID')
        ->where('danhgia.tourID', $id)
        ->select(
            'danhgia.*',
            'users.fullname',
            'users.hinh'
        )
        ->orderBy('danhgia.created_at', 'desc')
        ->get();
    $countReview = $getReviews->count();
    $avgStar = $getReviews->avg('sosao');
    return view('clients.chitiet_tour', compact('title', 'chitiet_tour', 'getReviews','countReview','avgStar', 'bookingID'));
    }
   
    public function store(Request $request)
    {
    $userID = session('login_user_id');
    if (!$userID) {
        return redirect('/login')->with('error', 'Vui lòng đăng nhập');
    }
    DB::table('danhgia')->insert([
        'tourID' => $request->tourID,
        'userID' => $userID,
        'bookingID' => $request->bookingID,
        'sosao' => $request->sosao,
        'binhluan' => $request->binhluan,
        'created_at' => now()
    ]);

    return back()->with('success', 'Đánh giá thành công');
    }
}
