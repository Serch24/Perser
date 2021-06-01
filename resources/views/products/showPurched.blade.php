@extends('layouts.master')
@section('tittle','Purched - perser')
@section('body')
    <div class="container">
        @if(isset($products))
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $pos => $product)
                    <tr>
                        <td>{{$pos}}</td> 
                        <td>{{$product->name}}</td> 
                        <td>{{$product->price}}</td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="col">
                <p>No purched yes :(</p>
            </div>
        @endif 
    </div>
@endsection