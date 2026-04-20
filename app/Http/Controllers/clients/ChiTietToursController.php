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
    $bookingID = DB::table('booking')
    ->join('tours', 'booking.tourID', '=', 'tours.tourID')
    ->where('booking.userID', session('userID'))
    ->where('booking.tourID', $id)
    ->where('booking.status', 'confirmed')
    ->where('tours.ngayketthuc', '<', now())
    ->value('booking.bookingID');
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
    //dd($request->bookingID);
    $userID = session('userID'); 
    if (!$userID) {
        return redirect('/login')->with('error', 'Vui lòng đăng nhập');
    }
    $hasBooked = DB::table('booking') 
    ->join('tours', 'booking.tourID', '=', 'tours.tourID')
    ->where('booking.bookingID', $request->bookingID) 
    ->where('booking.userID', $userID)
    ->where('booking.status', 'confirmed')
    ->where('tours.ngayketthuc', '<', now())
    ->exists();

    if (!$hasBooked) {
    return back()->with('error', 'Bạn phải hoàn thành chuyến đi mới được đánh giá!');
    }

    $alreadyReviewed = DB::table('danhgia')
        ->where('bookingID', $request->bookingID)
        ->where('userID', $userID)
        ->exists();

    if ($alreadyReviewed) {
        return back()->with('error', 'Bạn đã đánh giá cho lần đặt tour này rồi!');
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
