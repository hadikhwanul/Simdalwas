<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use App\Models\Rekomendasi;
use App\Models\Tindak;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TindakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rekomendasi = Rekomendasi::latest()->paginate(10)->withQueryString();
        return view('Tindak.index', [
            'judul' => 'Tindak Lanjut',
            'rekomendasi' => $rekomendasi,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($slug)
    {
        $rekomendasi = Rekomendasi::where('slug', $slug)->firstOrFail();
        return view('Tindak.create', [
            'judul' => 'Tindak Lanjut',
            'rekomendasi' => $rekomendasi,
        ]);
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
    public function show(Tindak $tindak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tindak $tindak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tindak $tindak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tindak $tindak)
    {
        //
    }
}