<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ToursModel;
use Carbon\Carbon;

class ToursManagementController extends Controller
{
    private $tours;

    public function __construct()
    {
        $this->tours = new ToursModel();
    }

     public function index(Request $request)
    {
        $title = 'Danh sách Tours';
        $keyword = $request->keyword;
        $mien = $request->mien;
        $price = $request->price;
        $tours = $this->tours->getAllTours($keyword, $mien, $price);
        return view('admin.list', compact('title', 'tours', 'keyword', 'mien', 'price'));
    }

    public function create()
    {
        $title = 'Thêm Tour';
        return view('admin.add-tours', compact('title'));
    }
    public function addTours(Request $request)
    {
        $start = Carbon::createFromFormat('d-m-Y', $request->ngaybatdau);
        $end   = Carbon::createFromFormat('d-m-Y', $request->ngayketthuc);
        if ($start->gt($end)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ngày kết thúc phải lớn hơn ngày bắt đầu!');
        }
        $startDate = $start->format('Y-m-d');
        $endDate   = $end->format('Y-m-d');
        $days = $start->diffInDays($end);
        $nights = $days - 1;

        $time = $nights > 0 
            ? "{$days}N{$nights}Đ" 
            : "{$days}N";

        $mainImage = null;
        if ($request->hasFile('images') && count($request->file('images')) > 0) {

            $files = $request->file('images');

            $first = $files[0];
            $mainImage = time() . '_' . $first->getClientOriginalName();
            $first->move(public_path('admin/assets/images/tours'), $mainImage);
        }
        $tourID = $this->tours->createTours([
            'title'        => $request->title,
            'mota'         => $request->mota,
            'socho'        => $request->socho,
            'gia_nguoiLon' => $request->gia_nguoiLon,
            'gia_emBe'     => $request->gia_emBe,
            'diemden'      => $request->diemden,
            'mien'         => $request->mien,
            'hinh'         => $mainImage,
            'thoigian'     => $time,
            'tinhkhadung'  => 1,
            'ngaybatdau'   => $startDate,
            'ngayketthuc'  => $endDate
        ]);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {

                if ($index == 0) continue;

                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('admin/assets/images/tours'), $filename);

                $this->tours->insertImage([
                    'tourID' => $tourID,
                    'imgurl' => $filename
                ]);
            }
        }
        if ($request->timeline) {
            $this->tours->insertTimeline([
                'tourID' => $tourID,
                'title'  => 'Ngày 1',
                'mota'   => $request->timeline
            ]);
        }

        return redirect('/admin/tours')->with('success', 'Thêm tour thành công!');
    }
    public function deleteTour($id)
    {
        $this->tours->deleteTour($id);
        return redirect('/admin/tours')->with('success', 'Xóa thành công!');
    }
    public function edit($id)
    {
        $tour = $this->tours->getTourById($id);
        $title = 'Sửa tour';

        return view('admin.edit-tours', compact('tour', 'title'));
    }
    public function getTourDetail($id)
    {
        return response()->json([
            'tour'     => $this->tours->getTourById($id),
            'images'   => $this->tours->getImagesByTourId($id),
            'timeline' => $this->tours->getTimelineByTourId($id)
        ]);
    }
    public function updateTour(Request $request, $id)
    {
        $start = Carbon::createFromFormat('d-m-Y', $request->ngaybatdau);
        $end   = Carbon::createFromFormat('d-m-Y', $request->ngayketthuc);
        if ($start->gt($end)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ngày kết thúc phải lớn hơn ngày bắt đầu!');
        }

        $startDate = $start->format('Y-m-d');
        $endDate   = $end->format('Y-m-d');
        $days = $start->diffInDays($end);
        $nights = $days - 1;

        $time = $nights > 0 
            ? "{$days}N{$nights}Đ" 
            : "{$days}N";

        $data = [
            'title'        => $request->title,
            'mota'         => $request->mota,
            'socho'        => $request->socho,
            'gia_nguoiLon' => $request->gia_nguoiLon,
            'gia_emBe'     => $request->gia_emBe,
            'diemden'      => $request->diemden,
            'mien'         => $request->mien,
            'ngaybatdau'   => $startDate,
            'ngayketthuc'  => $endDate,
            'thoigian'     => $time
        ];
        if ($request->hasFile('images') && count($request->file('images')) > 0) {

            $files = $request->file('images');

            $first = $files[0];
            $filename = time().'_'.$first->getClientOriginalName();
            $first->move(public_path('admin/assets/images/tours'), $filename);

            $data['hinh'] = $filename;

            $this->tours->deleteImages($id);

            foreach ($files as $index => $file) {
                if ($index == 0) continue;

                $name = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('admin/assets/images/tours'), $name);

                $this->tours->insertImage([
                    'tourID' => $id,
                    'imgurl' => $name
                ]);
            }
        }
        if ($request->timeline) {
            $this->tours->deleteTimeline($id);

            $this->tours->insertTimeline([
                'tourID' => $id,
                'title'  => 'Ngày 1',
                'mota'   => $request->timeline
            ]);
        }
        $this->tours->updateTour($id, $data);
        return redirect('/admin/tours')->with('success', 'Cập nhật thành công!');
    }
}