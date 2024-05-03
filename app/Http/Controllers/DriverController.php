<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    // Add a new driver
    public function addDriver(Request $request)
    {
        // Validate input data
        $request->validate([
            'driverName' => 'required|string|max:255',
            'driveUserName' => 'required|string|max:255|unique:users,username',
            'driverPassword' => 'required|string|min:8',
        ]);

        // Create the driver
        $driver = new User();
        $driver->name = $request->driverName;
        $driver->username = $request->driveUserName;
        $driver->password = Hash::make($request->driverPassword);
        $driver->role = 'driver';
        $driver->save();

        return response()->json(['message' => 'Driver added successfully']);
    }

    public function getDriver($id)
    {
        $driver = User::where('id', $id)
                      ->where('role', 'driver')
                      ->firstOrFail();

        return response()->json(['driver' => $driver]);
    }

    // Edit an existing driver
    public function editDriver(Request $request, $id)
    {
        // Find the driver
        $driver = User::findOrFail($id);

        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the driver
        $driver->name = $request->name;
        // Update other properties as needed
        $driver->save();

        return response()->json(['message' => 'Driver updated successfully']);
    }

    // Delete an existing driver
    public function deleteDriver($id)
    {
        // Find the driver
        $driver = User::findOrFail($id);

        // Delete the driver
        $driver->delete();

        return response()->json(['message' => 'Driver deleted successfully']);
    }

    
}
