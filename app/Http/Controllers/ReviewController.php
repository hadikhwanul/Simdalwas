<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return view('Review.index',[
            "judul" => "Review Draft LHP",
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
    public function show(Request $draft)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $draft)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Draft $draft)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $draft)
    {
        //
    }
}
