@extends('layouts.master')
@section('body')
<div class="container">
    <div class="row justify-content-around bg-custom">
        <div class="col-4 border bg-white my-2 shadow-sm p-3 mb-5 rounded text-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="w-50">
                    <img src="{{ $user->profile_image ?? asset('default-profile.png') }}" class="img-fluid" alt="profile image">
                </div>
            </div>
            <h2>{{ $user->name ?? 'jhon' }}
                {{ $user->last_name ?? 'doe' }}</h2>
            <span class="text-muted d-block">{{$user->money ?? 'No money'}} {{ isset($user->money) ? '€' : ''}}</span>
            <a href="{{ route('edit-profile') }}" class="btn btn-secondary my-2">Editar</a>
            <a href="#" class="btn btn-danger my-2">Eliminar</a>
        </div>

        <div class="col-7 border bg-white my-2 shadow-sm p-3 mb-5 rounded text-center">
            <h2>Your products on sale</h2>
            <div class="row">
                @isset($products)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}€</td>
                                    <td><a href="{{route('show-product',[$product->id])}}" class="btn btn-secondary" data-placement='top' data-toggle="tooltip" title="Edit">
                                        <i class="far fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endisset
            </div>
        </div>

        <div class="col-4 border bg-white my-2 shadow-sm p-3 mb-5 rounded text-center">
            aaaaa
        </div>

        <div class="col-7 border bg-white my-2 shadow-sm p-3 mb-5 rounded text-center">
            <h3>Comments on your products</h3>
        </div>
    </div>
</div>
@endsection
