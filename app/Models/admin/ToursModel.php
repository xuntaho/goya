<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ToursModel extends Model
{
    protected $table = 'tours';
    public function getAllTours($keyword = null, $mien = null, $price = null)
    {
        $query = DB::table('tours')->where('ngayketthuc', '>=', now());
        if (!empty($keyword)) {
            if (is_numeric($keyword)) {
                $query->where('tourID', $keyword);
            } else {
                $query->where(function ($q) use ($keyword) {
                    $q->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('diemden', 'like', '%' . $keyword . '%')
                    ->orWhere('mien', 'like', '%' . $keyword . '%');
                });
            }
        }
        if (!empty($mien)) {
            $query->where('mien', $mien);
        }
        if (!empty($price)) {
            if ($price == '1') {
                $query->where('gia_nguoiLon', '<', 2000000);
            } elseif ($price == '2') {
                $query->whereBetween('gia_nguoiLon', [2000000, 5000000]);
            } elseif ($price == '3') {
                $query->where('gia_nguoiLon', '>', 5000000);
            }
        }
        return $query->get();
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