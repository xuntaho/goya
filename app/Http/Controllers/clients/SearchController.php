<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class SearchController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Tìm kiếm';

        $query = DB::table('tours')
            ->leftJoin('danhgia', 'tours.tourID', '=', 'danhgia.tourID')
            ->select(
                'tours.*',
                DB::raw('AVG(danhgia.sosao) as avg_rating'),
                DB::raw('COUNT(danhgia.id) as total_review')
            );
        if ($request->keyword) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }
        if ($request->mien) {
        $query->where('tours.mien', 'like', '%' . trim($request->mien) . '%');
        }
        if ($request->start_date && $request->end_date) {
        $start = Carbon::createFromFormat('d-m-Y', $request->start_date)->format('Y-m-d');
        $end = Carbon::createFromFormat('d-m-Y', $request->end_date)->format('Y-m-d');

        $query->whereBetween('tours.ngaybatdau', [$start, $end]);
    }
        $tours = $query->groupBy('tours.tourID')->get();

        return view('clients.search', compact('tours', 'title'));
    }
}
