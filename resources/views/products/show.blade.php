@extends('layouts.master')
@section('bread', Breadcrumbs::render('product-show', $product))
@section('body')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 row justify-content-center">
                <div class="col-lg align-self-center text-center">
                    <img src="{{$product->image}}" class="rounded img-fluid" alt="">
                </div>
                <div class="col-lg my-2">
                    <h2 class="text-center" style="font-family:'Times New Roman', Times, serif ">
                        {{$product->name}}
                    </h2>
                    <p class="text-muted text-center">{{$product->price}} €</p>
                    <p class="text-wrap text-center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">{{$product->description}} 
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, vero quas illum libero earum fuga voluptatum blanditiis nam reiciendis. Rem corporis modi quia. Atque, autem facilis alias velit aliquam a.</p>
                </div>
            </div>

            <div class="col-lg-12 my-3 row justify-content-center">
                <div class="col row justify-content-end">
                    <a href="{{ route('buy', ['product' => $product]) }}" class="btn btn-primary btn-lg"
                        data-placement="top" data-toggle="tooltip" title="Buy Product">
                        <i class="far fa-credit-card fa-2x"></i>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('cart', ['product' => $product]) }}" class="btn btn-secondary btn-lg"
                        data-placement="top" data-toggle="tooltip" title="Add to cart">
                        <i class="fas fa-shopping-cart fa-2x"></i>
                    </a>
                </div>
                
            </div>
        </div>
    </div>
@endsection