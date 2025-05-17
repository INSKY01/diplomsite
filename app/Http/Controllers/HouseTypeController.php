<?php

namespace App\Http\Controllers;

use App\Models\HouseType;
use Illuminate\Http\Request;

class HouseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $houseTypes = HouseType::all();
        return response()->json($houseTypes);
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

        $houseType = HouseType::create($validated);
        return response()->json($houseType, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $houseType = HouseType::findOrFail($id);
        return response()->json($houseType);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $houseType = HouseType::findOrFail($id);
        return response()->json($houseType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $houseType = HouseType::findOrFail($id);
        $houseType->update($validated);
        return response()->json($houseType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $houseType = HouseType::findOrFail($id);
        $houseType->delete();
        return response()->json(['success' => true]);
    }
} 