@extends('layouts.master')
@section('bread', Breadcrumbs::render('product-show', $productt))
@section('body')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 row justify-content-center">
                <div class="col-lg align-self-center text-center">
                    <img src="{{$productt->image}}" class="rounded img-fluid" alt="">
                </div>
                <div class="col-lg my-2">
                    <h2 class="text-center" style="font-family:'Times New Roman', Times, serif ">
                        {{$productt->name}}
                    </h2>
                    <p class="text-muted text-center">{{$productt->price}} €</p>
                    <p class="text-wrap text-center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">{{$productt->description}} 
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, vero quas illum libero earum fuga voluptatum blanditiis nam reiciendis. Rem corporis modi quia. Atque, autem facilis alias velit aliquam a.</p>
                </div>
            </div>

            {{-- buttons --}}
            <div class="col-lg-12 my-5 row justify-content-center">
                <div class="col row justify-content-end">
                    <a href="{{ route('buy', ['product' => $productt]) }}" class="btn btn-primary btn-lg"
                        data-placement="top" data-toggle="tooltip" title="Buy Product">
                        <i class="far fa-credit-card fa-2x"></i>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('add-cart', ['product' => $productt]) }}" class="btn btn-secondary btn-lg"
                        data-placement="top" data-toggle="tooltip" title="Add to cart">
                        <i class="fas fa-shopping-cart fa-2x"></i>
                    </a>
                </div>
            </div>

            {{-- produts related --}}
            @if(isset($productsRelated) && count($productsRelated) !== 0)
                <div class="col-lg-12 my-4">
                    <h3 class="text-center mb-4">You may be interested in this products</h3>
                    <div class="row row-cols-1 row-cols-lg-4">
                        @foreach($productsRelated as $product) 
                            <div class="col mb-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <img src="{{$product->image}}" class="card-img-top" alt="teto alt">
                                        <p class="card-title">{{$product->name}}</p>
                                        <p class="text-success font-weight-bold">{{$product->price}}€</p>
                                        <span class="text-muted text-right d-block" style="margin-top: -20px !important">by {{ $product->user()->name ?? '' }}</span>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="/product/{{$product->id}}" class="btn btn-primary mt-1">See product</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-center my-3">
                                {{ $productsRelated->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- input text --}}
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

            {{-- comments --}}
            <div class="row w-100 justify-content-center mb-4" style="max-height: 400px !important; overflow-y: scroll !important">
                <div class="col-md-11 border bg-white my-2 p-3 shadow-sm rounded" id="commentsField">
                    @if (isset($comments) && count($comments) !== 0)
                        @foreach ($comments as $comment)
                            <div class='alert alert-primary'>
                                <div class='d-flex justify-content-between'>
                                    <h4 class='alert-heading d-inline mb-0'>{{$comment->user->name}}</h4>
                                    <span class='d-inline text-muted text-right'>{{$comment->created_at}}</span>
                                </div>
                                <hr>
                                <div class="h-auto" style="word-break: break-word">
                                    {{$comment->comment}}
                                </div>
                            </div>
                        @endforeach
                    @endif
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

            let url =  '/comments/' + {{$productt->id}};
            console.log(url);

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
                        <div style='word-break: break-word'>
                            ${element.comment}
                        </div>
                    </div>
                `;
            });
        }

        window.addEventListener('DOMContentLoaded', () => {
            events();
        });
    </script>
@endpush