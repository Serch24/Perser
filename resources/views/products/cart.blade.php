@extends('layouts.master')
@section('bread', Breadcrumbs::render('cart'))
@section('body')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </div> 
                @elseif (session('deleted'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('deleted') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </div> 
                @endif
            </div>

            @if(isset($carts) && count($carts) !== 0)
                <table class="table text-center table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $pos => $cart)
                        <tr>
                            <td>{{$pos}}</td> 
                            <td>{{$cart->product->name}}</td> 
                            <td>{{$cart->product->price}} €</td> 
                            <td>
                                <a href="{{route('show-product', [$cart->product->id])}}" data-placement='top' data-toggle="tooltip" title="Show">
                                    <i class="far fa-eye"></i>
                                </a>
                                <a href="{{route('remove-cart', ['product' => $cart->product->id])}}">
                                    <i class="far fa-trash-alt" id="sendRemove" data-placement='top' data-toggle="tooltip" title="remove product from cart"></i>
                                </a> 
                            </td> 
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-lg-12 row justify-content-end">
                    <form action="{{ route('buy-cart') }}" method="post">
                        @csrf
                        <button class="btn btn-primary btn-lg">Buy</button>
                    </form>
                </div>
            @else
                <div class="col-lg-12 text-center">
                    <h2>There are not products in your cart</h2>
                    <h2>(╯°□°)╯</h2>
                </div>
            @endif 
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let remove = document.querySelector('#sendRemove');
        let sendForm = document.querySelector('#sendFormRemove');
        remove.addEventListener('click', () => {
            sendForm.submit();
        });
    </script>
@endpush