<?php

namespace App\Http\Controllers;

use App\Models\Facade;
use Illuminate\Http\Request;

class FacadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facades = Facade::all();
        return response()->json($facades);
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

        $facade = Facade::create($validated);
        return response()->json($facade);
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
        $facade = Facade::findOrFail($id);
        return response()->json($facade);
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

        $facade = Facade::findOrFail($id);
        $facade->update($validated);
        return response()->json($facade);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $facade = Facade::findOrFail($id);
        $facade->delete();
        return response()->json(['success' => true]);
    }
}
