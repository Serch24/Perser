@extends('layouts.master')
@section('tittle','Profile - perser')
@section('bread', Breadcrumbs::render('user'))
@section('body')
<div class="container">

    {{-- errors --}}
    <div class="row my-4">
        @if($errors->any()) 
            <div class="alert alert-danger w-100 text-center">
                <h3 class="text-center">Errors</h3>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="row justify-content-around bg-custom">
        <div class="col-md-4 border bg-white my-2 shadow-sm p-3 mb-5 rounded text-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="w-50">
                    <img src="{{ $user->profile_image ?? asset('default-profile.png') }}" class="img-fluid rounded-circle img-thumbnail" alt="profile image">
                </div>
            </div>
            <h2>{{ $user->name ?? 'jhon' }}
                {{ $user->last_name ?? 'doe' }}</h2>
            <span class="text-muted d-block">{{$user->money ?? 'No money'}} {{ isset($user->money) ? '€' : ''}}</span>
            <a href="{{ route('edit-profile') }}" class="btn btn-secondary my-2">Edit</a>
        </div>

        {{-- products on sale --}}
        <div class="col-md-7 border bg-white my-2 shadow-sm p-3 mb-5 rounded text-center" style="height: 300px;overflow-y: scroll !important">
            <div class="row">
                <div class="col-12">
                    <h2>Your products on sale</h2>
                </div>
                @if(count($products) !== 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Sold</th>
                                <th scope="col">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}€</td>
                                    <td><p class="font-weight-bold">{{ $product->available === 0 ? 'yes' : 'no' }}</p></td>
                                    <td><a href="{{route('show-product',[$product->id])}}" class="btn btn-secondary" data-placement='top' data-toggle="tooltip" title="Edit">
                                        <i class="far fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="col-12 d-flex align-items-start justify-content-center text-wrap">
                        <p class="">No products on sale...</p>
                    </div>
                @endisset
            </div>
        </div>

        {{-- Products purchased --}}
        <div class="col-md-4 border bg-white my-2 shadow-sm p-3 mb-5 rounded text-center" id="purched" style="height: 300px;overflow-y: scroll !important">
            <h3>Purched Products</h3>
            <div class="row">
                @if(count($purched) !== 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purched as $product)
                                <tr>
                                    <td>{{ $product->name ?? ''}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col">
                        <a href="{{ route('purched') }}" class="btn btn-primary">show all</a>
                    </div>
                @else
                    <div class="col">
                        <p class="text-center mt-3">No purched products...</p>
                    </div>
                @endisset
            </div>
        </div>

        {{-- commets on your products--}}
        <div class="col-md-7 border bg-white my-2 shadow-sm p-3 mb-5 rounded text-center" style="height: 300px;overflow-y: scroll !important">
            some comments on your products
        </div>
    </div>
</div>
@endsection
