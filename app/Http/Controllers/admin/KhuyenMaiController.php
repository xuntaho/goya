<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\KhuyenMaiModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KhuyenMaiController extends Controller
{
    private $km;
    public function __construct()
    {
        $this->km = new KhuyenMaiModel();
    }
    public function index()
    {
        $title = 'Danh sách khuyến mãi';
        $list = $this->km->getAllKM();
        return view('admin.listKM', compact('list', 'title'));
    }
   public function store(Request $req)
    {
        if ($req->type_km == 'auto') {
            if (empty($req->tourID)) {
                return back()->with('error', 'Vui lòng chọn tour');
            }
            $data = [
                'tourID' => $req->tourID,
                'code' => null
            ];
        } else { 
            if (empty($req->code)) {
                return back()->with('error', 'Vui lòng nhập mã giảm giá');
            }
            $exists = DB::table('khuyenmai')
                ->where('code', $req->code)
                ->exists();

            if ($exists) {
                return back()->with('error', 'Mã giảm giá đã tồn tại');
            }

            $data = [
                'tourID' => $req->tourID ?? null,
                'code' => $req->code
            ];
        }
        $this->km->createKM(array_merge($data, [
            'tenKM' => $req->code 
                        ? 'KM - ' . $req->code 
                        : 'KM Tour ' . $req->tourID,

            'discount' => $req->discount,
            'type' => $req->type,
            'soluong' => $req->soluong ?? 0,
            'trangthai' => 'active',

            'ngaybatdau' => Carbon::createFromFormat('d-m-Y', $req->ngaybatdau)->format('Y-m-d'),
            'ngayketthuc' => Carbon::createFromFormat('d-m-Y', $req->ngayketthuc)->format('Y-m-d'),
        ]));
        return back()->with('success', 'Thêm khuyến mãi thành công');
    }
    public function create()
    {
        $title = 'Thêm khuyến mãi';
        $tours = DB::table('tours')->get();
        return view('admin.khuyenmai', compact('title', 'tours'));
        
    }
    public function delete($id)
    {
        $this->km->deleteKM($id);
        return back()->with('success', 'Xóa thành công');
    }
    public function edit($id)
    {
        $title = 'Sửa khuyến mãi';
        $km = $this->km->getKMById($id);

        return view('admin.edit-khuyenmai', compact('km', 'title'));
    }
    public function update(Request $req, $id)
    {
        $start = Carbon::createFromFormat('d-m-Y', $req->ngaybatdau);
        $end = Carbon::createFromFormat('d-m-Y', $req->ngayketthuc);
        if ($end < $start) {
            return back()->with('error', 'Ngày kết thúc phải lớn hơn ngày bắt đầu');
        }
        DB::table('khuyenmai')
            ->where('kmID', $id)
            ->update([
                'discount' => $req->discount,
                'type' => $req->type,
                'soluong' => $req->soluong,
                'ngaybatdau' => $start->format('Y-m-d'),
                'ngayketthuc' => $end->format('Y-m-d'),
                'trangthai' => $req->trangthai ?? 'active',
            ]);
        return redirect()->route('admin.listKM')
            ->with('success', 'Cập nhật thành công');
    }
}