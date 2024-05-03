<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function addDiscount(Request $request)
    {

        $existingDiscount = Discount::where('customer_id', $request->customer_id)
            ->where('product_id', $request->product)
            ->first();

        if ($existingDiscount) {
            return response()->json(['message' => 'There is already a discount for this customer and product combination.']);
        } else {
            $discount = new Discount();
            $discount->customer_id = $request->customer_id;
            $discount->product_id = $request->product;
            $discount->discount_type = $request->discountType;
            $discount->discount_value = $request->discountValue;
            $discount->min_quantity = $request->minQuantity;
            $discount->max_quantity = $request->maxQuantity;
            $discount->free_pack_quantity = $request->freePackQuantity ?? null;
            $discount->save();

            return response()->json(['message' => 'Discount rule added successfully']);
        }
    }

    public function calculateDiscountedPrice($customerId, $productId, $quantity)
    {
        // Retrieve the discount rule 
        $discount = Discount::where('customer_id', $customerId)
            ->where('product_id', $productId)
            ->first();

        // Get the product price
        $productPrice = Product::find($productId)->price;

        // If no discount is found, calculate the total price without discount
        if (!$discount) {
            $totalPrice = $quantity * $productPrice;
            $totalQuantity = $quantity;
        } else {
            // Apply fixed amount discount
            $discountedPrice = $productPrice - $discount->discount_value;

            // Get after discount price
            $totalDiscountedPrice = $quantity * $discountedPrice;

            // Set total price and total quantity
            $totalPrice = $totalDiscountedPrice;
            $totalQuantity = $quantity;

            // Check FOC Discount
            switch ($discount->discount_type) {
                case 'free_of_charge':
                    if ($discount->discount_value == 0 && $quantity < $discount->min_quantity) {
                        $totalPrice = $quantity * $productPrice;
                        $totalQuantity = $quantity;
                    } elseif ($quantity >= $discount->min_quantity && $quantity <= $discount->max_quantity) {
                        $totalPrice = 0;
                    } else {
                        $excessQuantity = max(0, $quantity - $discount->max_quantity);
                        $excessPrice = $excessQuantity * $discountedPrice;
                        $totalPrice = $excessPrice;
                        $totalQuantity = $quantity;
                    }
                    break;
                case 'free_pack':
                    // Calculate number of free packs
                    $freePacks = floor($quantity / $discount->min_quantity);
                    $totalQuantity = $quantity + ($freePacks * $discount->free_pack_quantity);
                    $totalPrice = $quantity * $discountedPrice;
                    break;
            }
        }

        return ['totalPrice' => $totalPrice, 'totalQuantity' => $totalQuantity];
    }




    public function finalCalculations(Request $request)
    {
        $customerId = $request->customer_id;
        $productId = $request->product_id;
        $quantity = $request->quantity;

        $totalPrice = $this->calculateDiscountedPrice($customerId, $productId, $quantity);

        return response()->json(['total_price' => $totalPrice]);
    }
}
