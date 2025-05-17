<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $floors = Floor::all();
        return response()->json($floors);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.floors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'multiplier' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $floor = Floor::create($validated);
        return response()->json($floor);
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
        $floor = Floor::findOrFail($id);
        return response()->json($floor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'multiplier' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $floor = Floor::findOrFail($id);
        $floor->update($validated);
        return response()->json($floor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $floor = Floor::findOrFail($id);
        $floor->delete();
        return response()->json(['success' => true]);
    }
}
