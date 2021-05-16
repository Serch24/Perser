@extends('layouts.master')
@section('body')
<div class="container mt-5">
    <div class="table-responsive">
        <table class="table table-hover">
            <caption>{{$product->name}}...<caption>
            <thead class="thead-light">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">{{$product->id}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


@endsection
