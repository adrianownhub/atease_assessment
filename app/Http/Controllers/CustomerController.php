<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Add a new customer
    public function addCustomer(Request $request)
    {
        // Validate input data
        $request->validate([
            'customerName' => 'required|string|max:255',
            'customerAddress' => 'required|string|max:255',
            'driverId' => 'required|exists:users,id,role,driver',
        ]);

        // Create the customer
        $customer = new Customer();
        $customer->name = $request->customerName;
        $customer->address = $request->customerAddress;
        $customer->user_id = $request->driverId;
        // Set other properties as needed
        $customer->save();

        return response()->json(['message' => 'Customer added successfully']);
    }

    public function getCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        $allDrivers = User::where('role', 'driver')->get(['id', 'name']);
        return response()->json(['customer' => $customer, 'allDrivers' => $allDrivers]);
    }

    public function editCustomer(Request $request, $id)
    {
        // Find the customer
        $customer = Customer::find($id);

        // Check if customer exists
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'driverId' => 'required|exists:users,id,role,driver',
        ]);

        // Update the customer
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->user_id = $request->driverId;
        $customer->save();

        return response()->json(['message' => 'Customer updated successfully']);
    }

    public function deleteCustomer($id)
    {
        // Find the customer
        $customer = Customer::findOrFail($id);

        // Delete the customer
        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully']);
    }

}
