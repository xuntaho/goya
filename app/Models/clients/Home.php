<?php

namespace App\Models\clients;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $table = 'tours';

    public function getHomeTours()
    {
        $mienBac = DB::table('tours')
        ->where('mien', 'Bac')
        ->where('ngayketthuc', '>=', now())
        ->orderBy('tourID', 'desc')
        ->limit(2)
        ->get();

    $mienTrung = DB::table('tours')
        ->where('mien', 'Trung')
        ->where('ngayketthuc', '>=', now())
        ->orderBy('tourID', 'desc')
        ->limit(1)
        ->get();

    $mienNam = DB::table('tours')
        ->where('mien', 'Nam')
        ->where('ngayketthuc', '>=', now())
        ->orderBy('tourID', 'desc')
        ->limit(1)
        ->get();

    return $mienBac
        ->merge($mienTrung)
        ->merge($mienNam);
        

        // foreach ($tours as $tour) {
        //     $tour->hinh = DB::table('image')
        //     ->where('tourID', $tour->tourID)
        //     ->pluck('imgurl');

        //     // $tour->timeline = DB::table('timeline')
        //     //     ->where('tourID', $tour->tourID)
        //     //     ->pluck('title');
         //}
        return $tours;
    }
}
