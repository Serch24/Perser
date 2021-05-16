@extends('layouts.master')
@section('body')
    <h1 class="text-center">Perser</h1>
    @auth
        <div class="d-flex justify-content-end mb-3">
            <a href="/product/create" class="btn btn-primary">Crear producto</a>
        </div>
    @endauth
    <div class="container-fluid">
        <div class="card-columns">
            @foreach($products as $product) 
                <div class="card">
                    <div class="card-body">
                    <img src="{{$product->image}}" class="card-img-top" alt="teto alt">
                        <p class="card-title">{{$product->name}}</p>
                        <div class="card-text">
                            {{$product->description}}
                        </div>
                        <p>{{$product->price}}€</p>
                        <a href="/product/{{$product->id}}" class="btn btn-primary">Ver Producto</a>
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
