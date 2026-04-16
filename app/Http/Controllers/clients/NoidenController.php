<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Tours;
use Illuminate\Http\Request;

class NoidenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $tours;
    public function __construct()
    {
        $this->tours =  new Tours();
        
    }
    public function index()
    {
        $title='Điểm đến';
        $tours = $this->tours->getAllTours();
        $count = $tours->count();
        $hotTours = $this->tours->getHotDeals();
        $mien= $this->tours->getDomain();
        $mien_bac_count= optional($mien->firstWhere('mien', 'Bac'))->count;
        $mienCount = [
            'mien_bac' => optional($mien->firstWhere('mien', 'Bac'))->count,
            'mien_trung' => optional($mien->firstWhere('mien', 'Trung'))->count,
            'mien_nam' => optional($mien->firstWhere('mien', 'Nam'))->count,
            
        ];
        return view('clients.noiden', compact('title', 'tours', 'hotTours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
