<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ToursModel extends Model
{
    protected $table = 'tours';
   public function getAllTours($keyword = null, $mien = null, $price = null)
    {
        $query = DB::table('tours')
            ->leftJoin('booking', 'tours.tourID', '=', 'booking.tourID') // 🔥 thêm
            ->where('tours.ngayketthuc', '>=', now());
        if (!empty($keyword)) {
            if (is_numeric($keyword)) {
                $query->where('tours.tourID', $keyword);
            } else {
                $query->where(function ($q) use ($keyword) {
                    $q->where('tours.title', 'like', '%' . $keyword . '%')
                    ->orWhere('tours.diemden', 'like', '%' . $keyword . '%')
                    ->orWhere('tours.mien', 'like', '%' . $keyword . '%');
                });
            }
        }
        if (!empty($mien)) {
            $query->where('tours.mien', $mien);
        }
        if (!empty($price)) {
            if ($price == '1') {
                $query->where('tours.gia_nguoiLon', '<', 2000000);
            } elseif ($price == '2') {
                $query->whereBetween('tours.gia_nguoiLon', [2000000, 5000000]);
            } elseif ($price == '3') {
                $query->where('tours.gia_nguoiLon', '>', 5000000);
            }
        }
        return $query->select(
                'tours.*',
                DB::raw('COALESCE(SUM(booking.adult_count + booking.child_count),0) as booked'),
                DB::raw('(tours.socho - COALESCE(SUM(booking.adult_count + booking.child_count),0)) as conlai')
            )
            ->groupBy(
                'tours.tourID',
                'tours.title',
                'tours.diemden',
                'tours.mien',
                'tours.socho',
                'tours.gia_nguoiLon',
                'tours.gia_emBe',
                'tours.ngaybatdau',
                'tours.ngayketthuc',
                'tours.hinh',
                'tours.mota',
                'tours.tinhkhadung'
            )
            ->get();
    }
    public function createTours($data)
    {
        return DB::table($this->table)->insertGetId($data);
    }
    public function getTourById($tourId)
    {
        return DB::table($this->table)
            ->where('tourID', $tourId)
            ->first();
    }
    public function updateTour($tourId, $data)
    {
        return DB::table($this->table)
            ->where('tourID', $tourId)
            ->update($data);
    }
    public function insertImage($data)
    {
        if (is_array($data) && isset($data[0]) && is_array($data[0])) {
            return DB::table('image')->insert($data);
        }
        return DB::table('image')->insert([$data]);
    }
    public function uploadImages($data)
    {
        return $this->insertImage($data);
    }
    public function getImagesByTourId($tourId)
    {
        return DB::table('image')
            ->where('tourID', $tourId)
            ->get();
    }

    public function deleteImages($tourId)
    {
        return DB::table('image')
            ->where('tourID', $tourId)
            ->delete();
    }
    public function insertTimeline($data)
    {
        if (is_array($data) && isset($data[0]) && is_array($data[0])) {
            return DB::table('timeline')->insert($data);
        }

        return DB::table('timeline')->insert([$data]);
    }
    public function addTimeLine($data)
    {
        return $this->insertTimeline($data);
    }

    public function getTimelineByTourId($tourId)
    {
        return DB::table('timeline')
            ->where('tourID', $tourId)
            ->get();
    }

    public function deleteTimeline($tourId)
    {
        return DB::table('timeline')
            ->where('tourID', $tourId)
            ->delete();
    }
    public function deleteTour($tourId)
    {
        return DB::transaction(function () use ($tourId) {
            DB::table('timeline')->where('tourID', $tourId)->delete();
            DB::table('image')->where('tourID', $tourId)->delete();
            return DB::table($this->table)
                ->where('tourID', $tourId)
                ->delete();
        });
    }
}