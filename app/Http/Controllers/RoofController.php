<?php

namespace App\Http\Controllers;

use App\Models\Roof;
use Illuminate\Http\Request;

class RoofController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roofs = Roof::all();
        return response()->json($roofs);
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
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $roof = Roof::create($validated);
        return response()->json($roof);
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
    public function edit($id)
    {
        $roof = Roof::findOrFail($id);
        return response()->json($roof);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $roof = Roof::findOrFail($id);
        $roof->update($validated);
        return response()->json($roof);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $roof = Roof::findOrFail($id);
        $roof->delete();
        return response()->json(['success' => true]);
    }
}
