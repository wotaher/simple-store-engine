@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card p-3">
                @if(session()->get('product_created'))
                    <div class="alert alert-success" role="alert">
                        Product "{{session()->get('product_created')}}" got created.
                    </div>
                @endif
                @if(session()->get('delete_product'))
                    @php
                        $productName = session()->get('delete_product');
                        $isSuccess = session()->get('delete_status') === 'SUCCESS'
                    @endphp
                    <div class="alert {{ $isSuccess ? 'alert-success' : 'alert-danger' }}}" role="alert">
                        {{ $isSuccess ? 'Product "' .$productName.  '" got deleted.' : 'Failed to delete product "' . $productName . '".' }}
                    </div>
                @endif
                <div><a href="{{route('createProduct')}}" class="btn btn-primary">Create</a>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <th scope="row">{{$product->id}}</th>
                            <th>{{$product->name}}</th>
                            <td>{{$product->price / 100}}zł</td>
                            <td>
                                <a class="btn btn-primary" href="{{route('editProduct', ['product' => $product->id])}}">Edit</a>
                                <a class="btn btn-danger"
                                   href="{{route('destroyProduct', ['product' => $product->id])}}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
