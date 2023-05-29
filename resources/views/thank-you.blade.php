@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card p-3">
                <h1>Thank you</h1>
                <p>Thank you for placing your order.</p>
                <a href="{{route('catalog')}}" style="color:black">Back to main page</a>
            </div>
        </div>
        </div>
@endsection
