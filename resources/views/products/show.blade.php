@extends('layouts.master')
@section('bread', Breadcrumbs::render('product-show', $product))
@section('body')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 row justify-content-center">
                <div class="col-lg align-self-center text-center">
                    <img src="{{$product->image}}" class="rounded img-fluid" alt="">
                </div>
                <div class="col-lg my-2">
                    <h2 class="text-center" style="font-family:'Times New Roman', Times, serif ">
                        {{$product->name}}
                    </h2>
                    <p class="text-muted text-center">{{$product->price}} €</p>
                    <p class="text-wrap text-center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">{{$product->description}} 
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, vero quas illum libero earum fuga voluptatum blanditiis nam reiciendis. Rem corporis modi quia. Atque, autem facilis alias velit aliquam a.</p>
                </div>
            </div>

            <div class="col-lg-12 my-3 row justify-content-center">
                <div class="col row justify-content-end">
                    <a href="{{ route('buy', ['product' => $product]) }}" class="btn btn-primary btn-lg"
                        data-placement="top" data-toggle="tooltip" title="Buy Product">
                        <i class="far fa-credit-card fa-2x"></i>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('cart', ['product' => $product]) }}" class="btn btn-secondary btn-lg"
                        data-placement="top" data-toggle="tooltip" title="Add to cart">
                        <i class="fas fa-shopping-cart fa-2x"></i>
                    </a>
                </div>
                
            </div>

            <div class="col-lg-12 row my-4">
                <div class="col-lg-12 text-center">
                    <h3>Write some comments</h3>
                </div>
                <small id="emptyText" class="w-100 ml-3 form-text text-muted" style="display: none"> Empty field</small>
                <div class="col-9">
                    <input type="text" class="form-control" name="comment" placeholder="write comment" id="commentt">
                </div>
                <div class="col-2 row justify-content-center">
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <button class="btn btn-primary" type="button" id="button" role="button">Send</button>
                </div>
            </div>

            <div class="row w-100 justify-content-center">
                <div class="col-md-11 border bg-white my-2 p-3 shadow-sm rounded" id="commentsField">
                    @if (isset($comments) && count($comments) !== 0)
                        @foreach ($comments as $comment)
                            <div class='alert alert-primary'>
                                <div class='d-flex justify-content-between'>
                                    <h4 class='alert-heading d-inline mb-0'>{{$comment->user->name}}</h4>
                                    <span class='d-inline text-muted text-right'>{{$comment->created_at}}</span>
                                </div>
                                <hr>
                                <p class='mb-0'>{{$comment->comment}}</p>
                            </div>
                        @endforeach
                    @endif
                    {{-- falta añadir la logica para los comentarios por ajax :) --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let token = document.querySelector('[name="_token"]').value;
        let button = document.querySelector('#button');
        let comment = document.querySelector('#commentt');
        let emptyText = document.querySelector('#emptyText');

        function events(){
            button.addEventListener('click', (eve) => {
                if(comment.value !== ''){
                    emptyText.style.display = 'none';
                    getJson();
                    comment.value = '';
                }else{
                    emptyText.style.display = 'block';
                }
            });

            comment.addEventListener('keydown', (event) => {
                if(event.keyCode === 13){
                    if(comment.value !== ''){
                        emptyText.style.display = 'none';
                        getJson();
                        comment.value = '';
                    }else{
                        emptyText.style.display = 'block';
                    }
                }
            });
        }

        async function getJson(){
            let options = {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': token,
                    "Accept": "application/json, text-plain, */*",
                },
                body: JSON.stringify({
                    user_id: {{Auth::user()->id}},
                    comment: comment.value 
                }),
            };

            let url =  '/comments/' + {{$product->id}};

            let response = await fetch(url, options);

            if(response.ok){
                let allComments = await response.json();
                showComments(allComments);
            }else{
                console.log(response.text);
            }
        };

        function showComments({comments,users}){
            let field = document.querySelector('#commentsField');
            field.innerHTML = '';
            comments.forEach((element,index) => {
                field.innerHTML += `
                    <div class='alert alert-primary'>
                        <div class='d-flex justify-content-between'>
                            <h4 class='alert-heading d-inline mb-0'>${users[index]}</h4>
                            <span class='d-inline text-muted text-right'>${element.updated_at}</span>
                        </div>
                        <hr>
                        <p class='mb-0'>${element.comment}</p>
                    </div>
                `;
            });
        }

        window.addEventListener('DOMContentLoaded', () => {
            events();
        });
    </script>
@endpush