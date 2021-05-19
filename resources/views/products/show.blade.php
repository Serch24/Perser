@extends('layouts.master')
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
                        <form action="{{route('buy',['product' => $product->id])}}" method="post">
                            @csrf
                            <button class="btn btn-primary" data-placement='top' data-toggle="tooltip" title="Buy product">
                                <i class="far fa-credit-card fa-2x"></i>
                            </button>
                        </form>
                    </div>

                    <div class="col">
                        <form action="{{route('cart',['product' => $product->id])}}" method="post">
                            @csrf
                            <button class="btn btn-secondary" data-placement='top' data-toggle="tooltip" title="Add to cart">
                                <i class="fas fa-shopping-cart fa-2x"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection