<?php

namespace App\Models\clients;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $table = 'tours';

    public function getHomeTours()
    {
        return DB::table('tours')
        ->where('ngayketthuc', '>=', now())
        ->orderBy('tourID', 'desc')
        ->limit(4)
        ->get();
        

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
