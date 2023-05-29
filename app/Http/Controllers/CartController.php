<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\Product;

class CartController extends Controller
{
    public function add(AddToCartRequest $request, Product $product)
    {
        $quantity = $request->validated()['quantity'] * 1;

        if (!session()->exists('cart')) {
            session(['cart' => [$product->id => $quantity]]);
        } else {
            $cart = session()->pull('cart');

            if(array_key_exists($product->id, $cart)) {
                $cart[$product->id] = $cart[$product->id] + $quantity;
            } else $cart[$product->id] = $quantity;

            session(['cart' => $cart]);
        }


        return redirect(route('showCart'));
    }

    public function remove(Product $product) {
        if(!session()->exists('cart')) return; // TODO

        $cart = session()->pull('cart');
        unset($cart[$product->id]);

        session(['cart' => $cart]);

        return redirect(route('showCart'));
    }

    public function show() {
        $cart = [];

        if(session()->exists('cart')) {
            foreach(session()->get('cart') as $productId => $quantity) {
                $cart[] = ['product' => Product::find($productId), 'quantity' => $quantity];
            }
        }

        return view('cart.show', ['cart' => $cart]);
    }
}
