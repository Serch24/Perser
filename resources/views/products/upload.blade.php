@extends('layouts.master')
@section('bread', Breadcrumbs::render('product-create'))
@section('body')
<div class="container">
    <form action="/product" method="POST" enctype="multipart/form-data">
        @csrf

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

        <div class="form-row">
            {{-- name --}}
            <div class="col-md-6 mb-3">
                <label for="name" class="font-weight-bold">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="" placeholder="product name" autocomplete="off" required>
            </div>

            {{-- price --}}
            <div class="col-md-6 mb-3">
                <label for="price" class="font-weight-bold">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="" placeholder="product price" autocomplete="off" required>
            </div>
        </div>

        <div class="form-row mb-3">
            {{-- category --}}
            <div class="col-md-6">
                <label for="category"></label>
                <select name="category" class="custom-select" id="category" autocomplete="off">
                    <option value="" selected>Choose category</option>
                    @if (isset($categories) && count($categories) !== 0)
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{old('category') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            {{-- image file --}}
            <div class="col-md-6 custom-file mt-4">
                <input type="file" class="custom-file-input" id="file" name="file" autocomplete="off" accept="image/*">
                <label class="custom-file-label" for="validatedCustomFile">Choose image...</label>
            </div>
        </div>
        
        {{-- text area --}}
        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label for="description" class="font-weight-bold">Description</label>
                <textarea type="text" class="form-control" id="description" name="description" aria-describedby="description" autocomplete="off" required>
                </textarea>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Upload product</button>
    </form>
</div>
@endsection
