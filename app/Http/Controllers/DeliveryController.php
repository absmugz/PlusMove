<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Delivery;
use App\Http\Resources\DeliveryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DeliveryController extends Controller
{
    // Get all deliveries
    public function index()
    {
        return DeliveryResource::collection(Delivery::all());
    }

    // Get a specific delivery by ID
    public function show($id)
    {
        return new DeliveryResource(Delivery::findOrFail($id));
    }

    // Create a new delivery
    public function store(Request $request)
    {
        $validated = $request->validate([
            'driver_id' => 'required|exists:users,id',
            'status' => 'required|string',
        ]);

        $delivery = Delivery::create([
            'driver_id' => $validated['driver_id'],
            'status' => $validated['status'],
            'assigned_at' => now(),
        ]);

        return new DeliveryResource($delivery);
    }

    

    // Update delivery status
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:in-transit,delivered,returned',
        ]);

        $delivery = Delivery::findOrFail($id);
        $delivery->update(['status' => $validated['status']]);

        return new DeliveryResource($delivery);
    }

    // Delete a delivery
    public function destroy($id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->delete();

        return response()->json(['message' => 'Delivery deleted successfully']);
    }

    // Assign Drivers with Minimal Load - We need to assign drivers based on who has the least deliveries.
    public function assignDelivery(Request $request)
    {
        $validated = $request->validate([
            'city_id' => 'required|exists:cities,id',
        ]);

        // Find driver with the least deliveries in the city
        $driver = User::role('driver')
            ->whereHas('deliveries', function ($query) use ($validated) {
                $query->where('city_id', $validated['city_id']);
            })
            ->withCount('deliveries')
            ->orderBy('deliveries_count', 'asc')
            ->first();

        if (!$driver) {
            return response()->json(['error' => 'No drivers available'], 400);
        }

        $delivery = Delivery::create([
            'driver_id' => $driver->id,
            'city_id' => $validated['city_id'],
            'status' => 'pending',
            'assigned_at' => now(),
        ]);

        return new DeliveryResource($delivery);
    }
}
