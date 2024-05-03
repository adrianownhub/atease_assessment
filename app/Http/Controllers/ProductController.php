<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct(Request $request)
    {

        $request->validate([
            'productName' => 'required|string|max:255',
            'productPrice' => 'required|numeric|min:0',
        ]);

        // Create a new product
        $product = new Product();
        $product->name = $request->productName;
        $product->price = $request->productPrice;

        $product->save();

        return response()->json(['message' => 'Product added successfully']);
    }

    public function getProduct($id)
    {
        $product = Product::where('id', $id)
            ->firstOrFail();

        return response()->json(['product' => $product]);
    }

    public function editProduct(Request $request, $id)
    {
        // Find the product
        $product = Product::findOrFail($id);

        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the product
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();

        return response()->json(['message' => 'Product updated successfully']);
    }

    public function deleteProduct($id)
    {
        $driver = Product::findOrFail($id);

        $driver->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function loadProductsForDiscount()
    {
        $products = Product::all();
        return response()->json(['products' => $products]);
    }

    public function loadProductsForOrders()
    {
        $order_products = Product::all();
        return response()->json(['order_products' => $order_products]);
    }
}
