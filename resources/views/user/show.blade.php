@extends('layouts.master')
@section('body')
    <div class="container">
        <div class="row justify-content-around bg-custom">
            <div class="col-4 bg-white my-2">
                <img src="{{$user->profile_image}}" alt="text alt">
                <h2>{{$user->name}} {{$user->last_name ?? 'doe'}}</h2>
                <a href="#" class="btn btn-secondary my-2">Editar</a>
                <a href="#" class="btn btn-danger my-2">Eliminar</a>
            </div>

            <div class="col-7 bg-white my-4">
                cositassss
            </div>

            <div class="col-4 bg-white">
                aaaaa
            </div>
        </div>
    </div>
@endsection