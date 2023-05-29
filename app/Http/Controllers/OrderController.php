<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index', ['orders' => Order::all()]);
    }

    public function show(Order $order)
    {
        return view('orders.show', ['order' => $order, 'details' => $order->details()->get()->toArray()]);
    }

    public function store(StoreOrderRequest $request)
    {
        if (!session()->exists('cart')) throw new \Exception('Cart is missing.');
        else {
            $order = Order::create(array_merge($request->validated(), ['user_id' => 1]));

            $cart = session()->pull('cart');

            foreach ($cart as $productId => $quantity) {
                $product = Product::find($productId);

                OrderDetail::create(['order_id' => $order->id, 'product_id' => $productId, 'product_name' => $product->name, 'unit_price' => $product->price, 'quantity' => $quantity]);
            }

            return redirect(route('thankYouPage'));
        }
    }
}
