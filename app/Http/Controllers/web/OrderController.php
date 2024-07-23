<?php

namespace App\Http\Controllers\web;

use App\Events\OrderStatusUpdated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(3);
        return view('orders.index', compact('orders'));
    }

    public function create(Product $product)
    {
        return view('orders.create', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:50',
        ]);

        $product = Product::find($request->product_id);
        if (!$product) {
            return redirect()->back()->withErrors(['product_id' => 'Product not found.'])->withInput();
        }

        $order = Order::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $request->quantity * $product->price,
        ]);

        return redirect()->route('orders.index', $order);
    }


    public function updateStatus(Request $request, Order $order)
    {
        $order->update(['status' => $request->status]);

        // Trigger webhook
        event(new OrderStatusUpdated($order));

        return redirect(route('orders.index'));
    }


}
