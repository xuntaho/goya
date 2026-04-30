<?php

namespace App\Models\admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class KhuyenMaiModel extends Model
{
    protected $table = 'khuyenmai';
    public function getAllKM()
    {
        return DB::table('khuyenmai')
            ->leftJoin('tours', 'khuyenmai.tourID', '=', 'tours.tourID')
            ->select('khuyenmai.*', 'tours.title')
            ->orderByDesc('kmID')
            ->get();
    }
    public function createKM($data)
    {
        return DB::table('khuyenmai')->insert($data);
    }
    public function deleteKM($id)
    {
        return DB::table('khuyenmai')
            ->where('kmID', $id)
            ->delete();
    }
    public function getKMById($id)
    {
        return DB::table('khuyenmai')
            ->where('kmID', $id)
            ->first();
    }
   public function updateKM($id, $data)
    {
        return DB::table('khuyenmai')
            ->where('kmID', $id)
            ->update($data);
    }
}