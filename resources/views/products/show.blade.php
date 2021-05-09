@extends('layouts.master')
@section('body')
    <div class="container">
        <div class="card mb-3">
            <img src="{{$product->image}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$product->name}}</h5>
                <p class="card-text">{{$product->description}}</p>
                <p>{{$product->price}}</p>
            </div>
        </div>
    </div>
@endsection