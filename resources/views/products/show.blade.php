@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('catalog')}}" style="color: black">&larr; Back to products</a>
        <div class="row justify-content-center">
            <div class="card p-3">
                    <div style="padding: 0 1rem; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <h1>{{$product->name}}</h1>
                            <p>{{$product->description}}</p>
                        </div>
                        <form action="{{route('addToCart', ['product' => $product->id])}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <h3>Price: {{$product->price / 100}}zł</h3>
                                <label for="quantity">Quantity</label>
                                <input id="quantity" name="quantity" type="number"
                                       class="form-control @error('quantity') is-invalid @enderror"
                                       required value="1">
                                @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Add to cart</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
@endsection
