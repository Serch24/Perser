@extends('layouts.master')
@section('body')
<form action="/product/buy" method="POST">
    @csrf
    <div class="container mt-5">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row justify-content-end">
            <div class="col-1">
                <button type="button" class="btn btn-success">Buy</button>
            </div>
        </div>
    </div>
</form>

@endsection
