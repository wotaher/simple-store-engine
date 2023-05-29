@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('catalog')}}" style="color: black;">&larr; Back to products</a>

        <div class="row justify-content-center">
            <div class="card p-3">
                <h3>Cart</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart as $cartItem)
                        <tr>
                            <th scope="row"><a
                                    href="{{route('showProduct', ['product'=> $cartItem['product']->id])}}" style="color: black;">{{$cartItem['product']->name}}</a>
                            </th>
                            <th>{{$cartItem['quantity']}}</th>
                            <td>{{($cartItem['quantity'] * $cartItem['product']->price) / 100}}zł</td>
                            <td>
                                <a class="btn btn-danger"
                                   href="{{route('removeFromCart', ['product' => $cartItem['product']->id])}}">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <h3>
                    Total: {{array_reduce($cart, function($carry, $cartItem) { return $carry + ($cartItem['product']->price * $cartItem['quantity']); }, 0) / 100}}
                    zł</h3>
                <h6>Free delivery included</h6>
                <h6>Payment via cash on delivery</h6>
            </div>
            <div class="card p-3 mt-3">
                <h3>Create order</h3>
                <form action="{{route('storeOrder')}}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">First name & last name</label>
                        <input type="text" id="name" name='name'
                               class="form-control @error('name') is-invalid @enderror" required value="{{old('name')}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name='email'
                               class="form-control @error('email') is-invalid @enderror" required value="{{old('email')}}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name='phone'
                               class="form-control @error('phone') is-invalid @enderror" required value="{{old('phone')}}">
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name='address'
                               class="form-control @error('address') is-invalid @enderror" required value="{{old('address')}}">
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="zip_code">Zip code</label>
                        <input type="text" id="zip_code" name='zip_code'
                               class="form-control @error('zip_code') is-invalid @enderror" required value="{{old('zip_code')}}">
                        @error('zip_code')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" name='city'
                               class="form-control @error('city') is-invalid @enderror" required value="{{old('city')}}">
                        @error('city')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <button type="submit" @if(!count($cart)) disabled @endif class="btn btn-primary mt-2">Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
