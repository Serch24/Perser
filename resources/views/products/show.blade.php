@extends('layouts.master')
@section('body')
    <div class="container-fluid">
        <div class="card mb-3">
            <img src="{{$product->image}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center">{{$product->name}}</h5>
                <p class="card-text">{{$product->description}}</p>
                <p>{{$product->price}}</p>
                <form action="{{route('buy',['product' => $product->id])}}" method="post">
                    @csrf
                    <button class="btn btn-primary">Comprar</button>
                </form>

                <form action="{{route('cart',['product' => $product->id])}}" method="post">
                    @csrf
                    <button class="btn btn-secondary">Carrito</button>
                </form>
            </div>
        </div>
    </div>
@endsection