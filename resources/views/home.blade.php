@extends('layouts.master')

@section('body')
    @if (Auth::check())
        <h1>Buenas {{Auth::user()->name}}</h1>
    @else
        <h1>Logeate!!!!</h1>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Labore sed praesentium temporibus nesciunt minima ducimus cum aut quam, provident animi eligendi accusamus facilis odio ullam voluptates modi quosero fugiat nam! Adipisci sequi sit sed pariatur minima at maxime, deserunt aliquid temporaorem  eum velit temporibus earum ad et molestiae dolorum deleniti magni cum, autem illo tempore cio dolor alias atque temporibus cupiditate tenetur quos laudantium reprehenderit. Error, unde ab.
        Delectus vel quas qui! Porro, vel, illum doloremque qui recusandae eveniet, unde fugit tempore veniam eligendiodi id libero fugiat nam! Adipisci sequi sit sed pariatur minima at maxime, deserunt aliquid tempora!</p>
    @endif
@endsection
