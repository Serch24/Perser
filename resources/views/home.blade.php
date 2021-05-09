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
                    <img src="{{$product->image}}" alt="teto alt">
                    <div class="card-body">
                        <p class="card-title">{{$product->name}}</p>
                        <div class="card-text">
                            {{$product->description}}
                        </div>
                        <p>{{$product->price}}</p>
                        <a href="/product/{{$product->id}}" class="btn btn-primary">Ver Producto</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
