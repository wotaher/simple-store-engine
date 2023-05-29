<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.list', ['products' => Product::all()]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        $product = Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'],
        ]);


        return redirect(route('listProducts'))->with(['product_created' => $product->name]);
    }

    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product->updateOrFail($request->validated());
            $status = "SUCCESS";
        } catch (\Throwable $e) {
            $status = "FAIL";
        }

        return redirect(route('editProduct', ["product" => $product->id]))->with(["edit_status" => $status]);
    }

    public function destroy(Product $product)
    {
        try {
            $product->deleteOrFail();
            $status = "SUCCESS";
        } catch (\Throwable $e) {
            $status = "FAIL";
        }

        return redirect(route('listProducts'))->with(['delete_product' => $product->name, 'delete_status' => $status]);
    }

    public function catalog() {
        return view('products.catalog', ['products' => Product::all()]);
    }
}
