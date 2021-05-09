@extends('layouts.master')
@section('body')
<div class="container">
    <form action="/product" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" value="" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="price">Precio</label>
                <input type="text" class="form-control" id="price" value="" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>

        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="validatedCustomFile" accept="image/*" required>
            <label class="custom-file-label" for="validatedCustomFile">Elegir imagen...</label>
            <div class="invalid-feedback">Example invalid custom file feedback</div>
        </div>

        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label for="description">Description</label>
                <textarea type="text" class="form-control" id="description" aria-describedby="description" required>
                    </textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck3"
                    aria-describedby="invalidCheck3Feedback" required>
                <label class="form-check-label" for="invalidCheck3">
                    Aceptar terminos y condiciones
                </label>
                <div id="invalidCheck3Feedback" class="invalid-feedback">
                    Desbes aceptar los terminos y condiciones!
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Subir Producto</button>
    </form>
</div>
@endsection
