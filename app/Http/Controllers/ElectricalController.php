<?php

namespace App\Http\Controllers;

use App\Models\Electrical;
use Illuminate\Http\Request;

class ElectricalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $electrical = Electrical::all();
        return response()->json($electrical);
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
            'sockets' => 'nullable|integer',
            'switches' => 'nullable|integer',
            'lights' => 'nullable|integer',
        ]);

        // Добавляем значения по умолчанию, если поля не заданы
        if (!isset($validated['sockets'])) $validated['sockets'] = 10;
        if (!isset($validated['switches'])) $validated['switches'] = 5;
        if (!isset($validated['lights'])) $validated['lights'] = 8;

        $electrical = Electrical::create($validated);
        return response()->json($electrical);
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
        $electrical = Electrical::findOrFail($id);
        return response()->json($electrical);
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
            'sockets' => 'nullable|integer',
            'switches' => 'nullable|integer',
            'lights' => 'nullable|integer',
        ]);

        $electrical = Electrical::findOrFail($id);
        $electrical->update($validated);
        return response()->json($electrical);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $electrical = Electrical::findOrFail($id);
        $electrical->delete();
        return response()->json(['success' => true]);
    }
}
