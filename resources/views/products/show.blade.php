@extends('layouts.master')
@section('body')
    <div class="container-fluid">
        <div class="card mb-3">
            <img src="{{$product->image}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center">{{$product->name}}</h5>
                <p class="card-text">{{$product->description}}</p>
                <p>{{$product->price}}</p>
                <a href="{{route('buy',['product' => $product->id])}}" class="btn btn-primary">Comprar</a>
                <a href="{{route('cart',['product' => $product->id])}}" class="btn btn-secondary">Añadir al carrito</a>
            </div>
        </div>
    </div>
@endsection