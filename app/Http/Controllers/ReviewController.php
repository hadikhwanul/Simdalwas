<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $review = Draft::latest()->paginate(10)->withQueryString();
        return view('Review.index', [
            "judul" => "Review Draft LHP",
            "review" => $review,
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