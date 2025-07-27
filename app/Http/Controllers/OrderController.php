<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('items.product')->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Check product availability and calculate total
        $total = 0;
        $orderItems = [];

        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);

            if ($product->stock < $item['quantity']) {
                return response()->json([
                    'message' => "Not enough stock for product {$product->name}"
                ], 400);
            }

            $total += $product->price * $item['quantity'];
            $orderItems[] = [
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ];

            // Reduce stock
            $product->stock -= $item['quantity'];
            $product->save();
        }

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $total,
            'status' => 'pending',
        ]);

        // Create order items
        foreach ($orderItems as $item) {
            $item['order_id'] = $order->id;
            OrderItem::create($item);
        }

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order->load('items.product'),
        ], 201);
    }

    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->findOrFail($id);

        return response()->json($order);
    }
}
