<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Package::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     
        $package = Package::create([
            'delivery_id' => $request['delivery_id'],
            'customer_id' => $request['customer_id'],
            'status' => $request['status'],
        ]);

        return response()->json($package, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        return response()->json($package);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,delivered,returned',
        ]);

        $package->update($validated);

        return response()->json($package);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $package->delete();

        return response()->json(['message' => 'Package deleted successfully']);
    }
}
