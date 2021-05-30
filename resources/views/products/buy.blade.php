@extends('layouts.master')
@section('body')
<form action="/product/buy" name="myform" method="POST">
    @csrf
    <div class="container mt-5">
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
        <input type="hidden" name="idProduct" value="{{$product->id}}">
        <div class="row justify-content-end">
            <div class="col-1">
                <button type="button" id="buyButton" class="btn btn-success">Buy</button>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
    <script>
        let buyButton = document.querySelector('#buyButton');

        buyButton.addEventListener('click', (even) => {
            document.forms['myform'].submit();
        });
    </script>
@endpush
