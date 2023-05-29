@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card p-3">
                <h3>Edit product {{$product->name}}</h3>

                <form action="{{route('updateProduct', ["product" => $product->id])}}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               required value="{{$product->name}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price (gr)</label>
                        <input type="number" id="price" name='price'
                               class="form-control @error('price') is-invalid @enderror" value="{{$product->price}}">
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  required>{{$product->description}}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>

                @if(session()->get('edit_status'))
                    @php
                        $isSuccess = session()->get('edit_status') === 'SUCCESS'
                    @endphp
                    <div class="alert {{ $isSuccess ? 'alert-success' : 'alert-danger' }}" role="alert">
                        {{ $isSuccess ? 'Successfully modified the product.' : 'Something did not work as expected.' }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
