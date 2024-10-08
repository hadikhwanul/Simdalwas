<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use App\Http\Requests\StoreDraftRequest;
use App\Http\Requests\UpdateDraftRequest;

class DraftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('DraftLHP.index',[
            "judul" => "Draft LHP",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('DraftLHP.create',[
            "judul" => "Draft LHP",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDraftRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Draft $draft)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Draft $draft)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDraftRequest $request, Draft $draft)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Draft $draft)
    {
        //
    }
}
