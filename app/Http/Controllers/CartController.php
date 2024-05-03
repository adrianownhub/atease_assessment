<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    // Function to add an order to the cart
    public function addToCart(Request $request)
    {

        // Create a new order record in the cart
        $order = new Order();
        $order->customer_id = $request->order_customer_id;
        $order->product_id = $request->order_product_id;
        $order->quantity = $request->order_quantity;
        $order->total_quantity = $request->totalQuantity;
        $order->total_price = $request->totalPrice;
        $order->save();

        
        return response()->json(['message' => 'Order added to cart successfully']);
    }

    // Function to view the cart
    public function viewCart()
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        // Check if the authenticated user is a driver
        if ($user->role !== 'driver') {
            return response()->json(['error' => 'User is not a driver'], 403);
        }

        // Retrieve orders for customers assigned to the driver
        $cartItems = Order::with(['product:id,name', 'customer:id,name'])
            ->whereHas('customer', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('confirmed', false)
            ->get(['id', 'product_id', 'customer_id', 'quantity', 'total_price']);

        return response()->json(['cart_items' => $cartItems]);
    }

    // Function to confirm the order from the cart
    public function confirmOrder()
    {
        $driver = auth()->user();

        // Check if the authenticated user is a driver
        if ($driver->role !== 'driver') {
            return response()->json(['error' => 'User is not a driver'], 403);
        }

        // Update the confirmed status of orders in the cart assigned to the driver
        $updatedOrders = Order::whereHas('customer', function ($query) use ($driver) {
            $query->where('user_id', $driver->id);
        })
            ->where('confirmed', false)
            ->update(['confirmed' => true]);

        if ($updatedOrders) {
            return response()->json(['message' => 'Orders confirmed and saved successfully']);
        } else {
            return response()->json(['message' => 'No orders to confirm'], 400);
        }
    }

    public function generatePDF()
    {
        // Retrieve the confirmed orders
        $driver = auth()->user();

        // Check if user is a driver
        if ($driver->role !== 'driver') {
            return response()->json(['error' => 'User is not a driver'], 403);
        }

        // Update the confirmed status of orders
        $confirmedOrders = Order::whereHas('customer', function ($query) use ($driver) {
            $query->where('user_id', $driver->id);
        })
            ->where('confirmed', true)
            ->get();

        // Calculate grand total
        $grandTotal = $confirmedOrders->sum('total_price');

      
        $invoiceDate = now()->format('Y-m-d');

        $pdfContent = '<h1 style="text-align: center;">Receipt</h1>';
        $pdfContent .= '<p>Invoice Date: ' . $invoiceDate . '</p>';

        $pdfContent .= '<p>Customer: ' . $confirmedOrders->first()->customer->name . '</p>';

        $pdfContent .= '<table style="margin: 0 auto; width: 80%; text-align: center;">';
        $pdfContent .= '<thead><tr><th>Product Name</th><th>Quantity</th><th>Subtotal</th></tr></thead>';
        $pdfContent .= '<tbody>';

        foreach ($confirmedOrders as $order) {
            $pdfContent .= '<tr>';
            $pdfContent .= '<td>' . $order->product->name . '</td>';
            $pdfContent .= '<td>' . $order->quantity . '</td>';
            $pdfContent .= '<td>' . $order->total_price . '</td>';
            $pdfContent .= '</tr>';
        }

        $pdfContent .= '</tbody>';
        $pdfContent .= '</table>';

        $pdfContent .= '<h3 style="text-align: right;">Grand Total: ' . $grandTotal . '</h3>';

        $pdf = PDF::loadHTML($pdfContent);

        $pdfPath = 'receipts/receipt_' . time() . '.pdf';
        Storage::disk('public')->put($pdfPath, $pdf->output());

        return response()->json(['pdf_path' => asset('storage/' . $pdfPath)]);
    }
}
