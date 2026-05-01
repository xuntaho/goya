<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CheckoutController extends Controller
{
    private $user;
    public function index($id)
    {   
        $title = 'Đặt tour';
        $tour = DB::table('tours')->where('tourID', $id)->first();
        $coupon = DB::table('khuyenmai')
        ->whereNotNull('code') // chỉ coupon
        ->where('trangthai', 'active')
        ->where('soluong', '>', 0)
        ->whereDate('ngaybatdau', '<=', now())
        ->whereDate('ngayketthuc', '>=', now())
        ->where(function($q) use ($id) {
            $q->where('tourID', $id)     
            ->orWhereNull('tourID');   
        })
        ->first();
       
         $autoKM = DB::table('khuyenmai')
        ->whereNull('code')
        ->where('trangthai', 'active')
        ->whereDate('ngaybatdau', '<=', now())
        ->whereDate('ngayketthuc', '>=', now())
        ->where(function($q) use ($id) {
            $q->where('tourID', $id)
            ->orWhereNull('tourID');
        })
        ->orderByRaw('tourID IS NULL')
        ->first();

        $user = null;
        $userID = session('userID');

        if ($userID) {
           $this->user = new User();
            $user = $this->user->getUser($userID);
        }
        return view('clients.checkout', compact('tour', 'title', 'coupon', 'user', 'autoKM'));
    }
  public function store(Request $request)
    {
        $userID = session('userID');
        if (!$userID) {
            return redirect('/login?redirect=checkout&tourID=' . $request->tourID);
        }

        $request->validate([
            'tourID' => 'required',
            'adult_count' => 'required|integer|min:1',
            'child_count' => 'nullable|integer|min:0',
            'payment_method' => 'required',
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[0-9]{10,11}$/',
            'address' => 'required|string|max:255'
        ]);

        if (!$request->has('agree')) {
            return back()->with('error', 'Bạn phải đồng ý điều khoản');
        }

        $tour = DB::table('tours')->where('tourID', $request->tourID)->first();

        if (!$tour) {
            return redirect('/')->with('error', 'Tour không tồn tại');
        }

        DB::beginTransaction();

        try {
            $child = $request->child_count ?? 0;

            $total = ($request->adult_count * $tour->gia_nguoiLon)
                + ($child * $tour->gia_emBe);

            $discount = 0;
            $kmID = null;

            $couponDiscount = 0;
            $couponKM = null;

            if ($request->coupon_code) {
                $couponKM = DB::table('khuyenmai')
                    ->where('code', $request->coupon_code)
                    ->where('trangthai', 'active')
                    ->where('soluong', '>', 0)
                    ->whereDate('ngaybatdau', '<=', now())
                    ->whereDate('ngayketthuc', '>=', now())
                    ->where(function($q) use ($request) {
                        $q->where('tourID', $request->tourID)
                        ->orWhereNull('tourID');
                    })
                    ->first();

                if ($couponKM) {
                    $couponDiscount = $couponKM->type == 'percent'
                        ? $total * $couponKM->discount / 100
                        : $couponKM->discount;
                }
            }

            $autoDiscount = 0;

            $autoKM = DB::table('khuyenmai')
                ->whereNull('code')
                ->where('trangthai', 'active')
                ->whereDate('ngaybatdau', '<=', now())
                ->whereDate('ngayketthuc', '>=', now())
                ->where(function($q) use ($request) {
                    $q->where('tourID', $request->tourID)
                    ->orWhereNull('tourID');
                })
                ->orderByRaw('tourID IS NULL')
                ->first();

            if ($autoKM) {
                $autoDiscount = $autoKM->type == 'percent'
                    ? $total * $autoKM->discount / 100
                    : $autoKM->discount;
            }

            if ($couponDiscount >= $autoDiscount) {
                $discount = $couponDiscount;
                $kmID = $couponKM->kmID ?? null;

                if ($couponKM) {
                    DB::table('khuyenmai')
                        ->where('kmID', $couponKM->kmID)
                        ->decrement('soluong');
                }
            } else {
                $discount = $autoDiscount;
                $kmID = $autoKM->kmID ?? null;
            }

            $finalTotal = max(0, $total - $discount);

            $bookingID = DB::table('booking')->insertGetId([
                'tourID' => $request->tourID,
                'userID' => $userID,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'booking_date' => now(),
                'adult_count' => $request->adult_count,
                'child_count' => $child,
                'total_price' => $finalTotal,
            
                'status' => 'pending',
                'created_at' => now()
            ]);

            DB::table('hoadon')->insert([
                'bookingID' => $bookingID,
                'tongtien' => $finalTotal,
                'ngayTT' => now(),
                'trangthai' => $request->payment_method == 'cash' ? 'pending' : 'paid',
                'mahoadon' => 'HD' . time(),
                'chitiet' => $request->payment_method == 'cash'
                    ? 'Thanh toán tại văn phòng'
                    : 'Thanh toán online',
                'created_at' => now()
            ]);

            DB::table('thanhtoan')->insert([
                'bookingID' => $bookingID,
                'pthucTT' => $request->payment_method,
                'ngaytt' => now(),
                'giatien' => $finalTotal,
                'trangthai' => $request->payment_method == 'cash' ? 'pending' : 'paid',
                'magd' => 'GD' . time(),
                'created_at' => now()
            ]);

            DB::table('lichsu')->insert([
                'userID' => $userID,
                'tourID' => $request->tourID,
                'loaihd' => 'booking',
                'created_at' => now()
            ]);

            DB::commit();

            if ($request->payment_method == 'cash') {
                return redirect('/')->with('success', 'Đặt tour thành công!');
            }
            if ($request->payment_method == 'bank') {
                return redirect()->route('bank.page', ['id' => $bookingID]);
            }
            if ($request->payment_method == 'momo') {
                return redirect()->route('momo.page', ['id' => $bookingID]);
            }
            return back()->with('error', 'Phương thức không hợp lệ');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra!');
        }
    }
    public function checkCoupon(Request $request)
    {
    $coupon = DB::table('khuyenmai')
        ->where('code', $request->code)
        ->where('trangthai', 'active')
        ->where('soluong', '>', 0)
        ->whereDate('ngaybatdau', '<=', now())
        ->whereDate('ngayketthuc', '>=', now())
        ->where(function($q) use ($request) {
            $q->where('tourID', $request->tourID)
              ->orWhereNull('tourID');
        })
        ->first();

    if (!$coupon) {
        return response()->json([
            'success' => false,
            'message' => 'Mã không hợp lệ hoặc không áp dụng cho tour này'
        ]);
    }

    return response()->json([
        'success' => true,
        'discount' => $coupon->discount,
        'type' => $coupon->type
    ]);
    }
    public function paymentSuccess(Request $request)
    {
        DB::table('thanhtoan')
            ->where('bookingID', $request->bookingID)
            ->update(['trangthai' => 'paid']);

        DB::table('hoadon')
            ->where('bookingID', $request->bookingID)
            ->update(['trangthai' => 'paid']);

        DB::table('booking')
            ->where('bookingID', $request->bookingID)
            ->update(['status' => 'confirmed']);

        return redirect('/')->with('success', 'Thanh toán thành công!');
    }
    public function bankPage($id)
    {
        $data = DB::table('booking')
            ->join('hoadon', 'booking.bookingID', '=', 'hoadon.bookingID')
            ->join('thanhtoan', 'booking.bookingID', '=', 'thanhtoan.bookingID')
            ->where('booking.bookingID', $id)
            ->select(
                'booking.*',
                'hoadon.tongtien',
                'hoadon.trangthai as hoadon_status',
                'thanhtoan.pthucTT',
                'thanhtoan.trangthai as payment_status'
            )
            ->first();

        if (!$data) {
            abort(404);
        }
        return view('clients.bank', compact('data'));
    }
   public function momoPage($id)
    {
        $data = DB::table('booking')
            ->join('hoadon', 'booking.bookingID', '=', 'hoadon.bookingID')
            ->join('thanhtoan', 'booking.bookingID', '=', 'thanhtoan.bookingID')
            ->where('booking.bookingID', $id)
            ->first();
        return view('clients.momo', compact('data'));
    }

}
