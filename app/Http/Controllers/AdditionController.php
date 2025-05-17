<?php

namespace App\Http\Controllers;

use App\Models\Addition;
use Illuminate\Http\Request;

class AdditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $additions = Addition::all();
        return response()->json($additions);
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
            'category' => 'required|string',
        ]);

        $addition = Addition::create($validated);
        return response()->json($addition);
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
        $addition = Addition::findOrFail($id);
        return response()->json($addition);
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
            'category' => 'required|string',
        ]);

        $addition = Addition::findOrFail($id);
        $addition->update($validated);
        return response()->json($addition);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $addition = Addition::findOrFail($id);
        $addition->delete();
        return response()->json(['success' => true]);
    }
}
