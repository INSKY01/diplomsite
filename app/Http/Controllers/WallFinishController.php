<?php

namespace App\Http\Controllers;

use App\Models\WallFinish;
use Illuminate\Http\Request;

class WallFinishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wallFinishes = WallFinish::all();
        return response()->json($wallFinishes);
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

        $wallFinish = WallFinish::create($validated);
        return response()->json($wallFinish);
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
        $wallFinish = WallFinish::findOrFail($id);
        return response()->json($wallFinish);
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

        $wallFinish = WallFinish::findOrFail($id);
        $wallFinish->update($validated);
        return response()->json($wallFinish);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $wallFinish = WallFinish::findOrFail($id);
        $wallFinish->delete();
        return response()->json(['success' => true]);
    }
}
