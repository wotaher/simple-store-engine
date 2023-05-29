@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="card p-3">
                <h1>Our products</h1>
                <div style="display: flex; flex-wrap: wrap; justify-content: center;">
                @foreach($products as $product)
                    <a class="card" style="width: 18rem; text-decoration: none !important; margin: 1rem;" href="{{route('showProduct', ['product' => $product->id])}}">
                        <div class="card-body">
                            <h5 class="card-title" style="color: #000;">{{$product->name}}</h5>
                            <p class="card-text">{{$product->price / 100}}zł</p>
                        </div>
                    </a>
                @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
