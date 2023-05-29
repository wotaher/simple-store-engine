@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('listOrders')}}" style="color: black;">&larr; Back to orders</a>

        <div class="row justify-content-center">
            <div class="card p-3">
                <h1>Order {{$order->id}} details</h1>
                <p>
                    {{$order->name}}
                    <br>
                    {{$order->address}}
                    <br>
                    {{$order->zip_code}} {{$order->city}}
                    <br>
                    {{$order->email}}
                    <br>
                    {{$order->phone}}
                </p>
                <h3>Total to pay: {{$order->getTotal()/100}}zł</h3>
                Products
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Product ID</th>
                        <th scope="col">Product name</th>
                        <th scope="col">Unit price</th>
                        <th scope="col">Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($details as $detail)
                        <tr>
                            <th scope="row">{{$detail['product_id']}}</th>
                            <th>{{$detail['product_name']}}</th>
                            <td>{{$detail['unit_price']/100}}zł</td>
                            <td>{{$detail['quantity']}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
