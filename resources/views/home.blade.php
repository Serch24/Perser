@extends('layouts.master')
@section('bread', Breadcrumbs::render('home'))
@section('body')
    <h1 class="text-center">Perser</h1>
    @auth
        <div class="d-flex justify-content-end mb-3">
            <a href="/product/create" class="btn btn-primary">Upload your product</a>
        </div>
    @endauth
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4">
            @foreach($products as $product) 
                <div class="col mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <img src="{{$product->image}}" class="card-img-top" alt="teto alt">
                            <p class="card-title">{{$product->name}}</p>
                            <p class="text-success font-weight-bold">{{$product->price}}€</p>
                            <span class="text-muted text-right d-block" style="margin-top: -20px !important">by {{ $product->user()->name ?? '' }}</span>
                        </div>
                        <div class="card-footer text-center">
                            <a href="/product/{{$product->id}}" class="btn btn-primary mt-1">See product</a>
                            {{-- <small class="text-muted">Last updated 3 mins ago</small> --}}
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
