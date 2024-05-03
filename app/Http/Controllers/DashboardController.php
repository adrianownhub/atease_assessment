<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Collection;


class DashboardController extends Controller
{
    public function index()
    {
        $drivers = User::where('role', 'driver')->get(['id', 'name']);

        return view('index', compact('drivers'));
    }

    public function driver_index()
    {
        $drivers = User::where('role', 'driver')->get(['id', 'name']);

        return view('driver_index', compact('drivers'));
    }

    public function loadDrivers()
    {

        $drivers = User::where('role', 'driver')->get(['id', 'name']);

        $processedData = new Collection;
        foreach ($drivers as $driver) {
            $buttons = '<button class="dropdown-item" type="button" id="editDriverBtn" name="editDriverBtn" data-id="' . $driver->id . '" >Edit</button>
            <button class="dropdown-item" type="button" id="deleteDriverBtn" name="deleteDriverBtn" data-id="' . $driver->id . '" >Delete</button>
            ';

            $actionBtn = '<span>
                    <div class="btn-group">
                        <button type="button"
                            class="btn btn-info btn-sm">Action</button>
                        <button type="button"
                            class="btn btn-info dropdown-toggle dropdown-icon"
                            data-toggle="dropdown" >
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">

                           ' . $buttons . '
                        </div>
                    </div></span>';

            $processedData->push([
                'name' => $driver->name,
                'action' => $actionBtn,
            ]);
        }

        return datatables()->of($processedData)
            ->addIndexColumn()
            ->make(true);
    }

    public function loadCustomers()
    {

        $customers = Customer::with('user:id,name')->get(['id', 'name', 'address', 'user_id']);

        $processedData = new Collection;
        foreach ($customers as $customer) {
            $buttons = '<button class="dropdown-item" id="editCustomerBtn" type="button" data-id="' . $customer->id . '">Edit</button>
                        <button class="dropdown-item" id="deleteCustomerBtn" type="button" data-id="' . $customer->id . '">Delete</button>   
                        <button class="dropdown-item create-discount-btn" data-id="' . $customer->id . '" >Add Discount</button>
                        ';

            $actionBtn = '<span>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info btn-sm">Action</button>
                                <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">' . $buttons . '</div>
                            </div>
                        </span>';

            $processedData->push([
                'name' => $customer->name,
                'address' => $customer->address,
                'user_name' => $customer->user->name,
                'action' => $actionBtn,
            ]);
        }


        return datatables()->of($processedData)
            ->addIndexColumn()
            ->make(true);
    }

    public function loadProducts()
    {
        $products = Product::get(['id', 'name', 'price']);

        $processedData = new Collection;
        foreach ($products as $product) {
            $buttons = '<button class="dropdown-item" type="button" id="editProductBtn" name="editProductBtn" data-id="' . $product->id . '" >Edit</button>
            <button class="dropdown-item" type="button" id="deleteProductBtn" name="deleteProductBtn" data-id="' . $product->id . '" >Delete</button>
            ';

            $actionBtn = '<span>
                    <div class="btn-group">
                        <button type="button"
                            class="btn btn-info btn-sm">Action</button>
                        <button type="button"
                            class="btn btn-info dropdown-toggle dropdown-icon"
                            data-toggle="dropdown" >
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">

                           ' . $buttons . '
                        </div>
                    </div></span>';

            $processedData->push([
                'name' => $product->name,
                'price' => $product->price,
                'action' => $actionBtn,
            ]);
        }

        return datatables()->of($processedData)
            ->addIndexColumn()
            ->make(true);
    }

    public function loadCustomersForDrivers()
    {
        // Get the authenticated driver
        $driverId = auth()->user()->id;

        // Retrieve customers assigned to the driver
        $customers = Customer::whereHas('user', function ($query) use ($driverId) {
            $query->where('id', $driverId);
        })
            ->with('user:id,name')
            ->get(['id', 'name', 'address', 'user_id']);

        $processedData = new Collection;
        foreach ($customers as $customer) {
            $buttons = '<button class="dropdown-item create-order-btn" data-id="' . $customer->id . '">Create Order</button>';

            $actionBtn = '<span>
                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-sm">Action</button>
                            <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">' . $buttons . '</div>
                        </div>
                    </span>';

            $processedData->push([
                'name' => $customer->name,
                'address' => $customer->address,
                'user_name' => $customer->user->name,
                'action' => $actionBtn,
            ]);
        }

        return datatables()->of($processedData)
            ->addIndexColumn()
            ->make(true);
    }
}
