<?php

namespace App\Http\Controllers;

use App\Models\LHP;
use App\Models\Draft;
use Illuminate\Http\Request;

class LHPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lhp = Draft::latest()->paginate(10)->withQueryString();
        return view('LHP.index', [
            "judul" => "LHP",
            "lhps" => $lhp,
        ]);
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
    public function show(LHP $lHP)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LHP $lHP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LHP $lHP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LHP $lHP)
    {
        //
    }
}