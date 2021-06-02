@extends('layouts.master')
@section('bread', Breadcrumbs::render('product-show', $product))
@section('body')
    <div class="container-fluid">
        <div class="card mb-3">
            <img src="{{$product->image}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center">{{$product->name}}</h5>
                <p class="card-text">{{$product->description}}</p>
                <p>{{$product->price}}</p>
                <div class="row">
                    <div class="col d-flex justify-content-end">
                        <a class="btn btn-primary" href="{{route('buy', ['product' => $product->id])}}" data-placement='top' data-toggle="tooltip" title="Buy product">
                            <i class="far fa-credit-card fa-2x"></i>
                        </a>
                    </div>

                    <div class="col">
                        <form action="{{route('cart',['product' => $product->id])}}" method="get">
                            @csrf
                            <button class="btn btn-secondary" data-placement='top' data-toggle="tooltip" title="Add to cart">
                                <i class="fas fa-shopping-cart fa-2x"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($productsRelated as $product)
                <p>{{$product}}</p>
            @endforeach
        </div>
    </div>
@endsection