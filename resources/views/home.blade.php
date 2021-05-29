@extends('layouts.master')
@section('body')
    <h1 class="text-center">Perser</h1>
    @auth
        <div class="d-flex justify-content-end mb-3">
            <a href="/product/create" class="btn btn-primary">Upload your product</a>
        </div>
    @endauth
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-md-5">
            @foreach($products as $product) 
                <div class="col mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{$product->image}}" class="card-img-top" alt="teto alt">
                            <p class="card-title">{{$product->name}}</p>
                            <p class="text-success font-weight-bold">{{$product->price}}€</p>
                            <a href="/product/{{$product->id}}" class="btn btn-primary">See product</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-center my-3">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
