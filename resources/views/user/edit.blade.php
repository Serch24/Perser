@extends('layouts.master')
@section('bread', Breadcrumbs::render('edit-user'))
@section('body')
<div class="container">

        @if($errors->any()) 
            <div class="row my-4">
                <div class="alert alert-danger w-100 text-center">
                    <h3 class="text-center">Errors</h3>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> - {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

    <div class="row text-center justify-content-around">
        <div class="col-lg-3 d-flex justify-content-center mb-2">
            <div class="w-50">
                <img src="{{$user->profile_image ?? asset('default-profile.png')}}" alt="profile image" class="img-fluid img-thumbnail">
            </div>
        </div>
        <div class="col-lg-8">
            <form action="/profile/update" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                {{-- name --}}
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <div class="input-group">
                            <div class=input-group-append">
                                <button class="btn btn-secondary editButtons">edit</button>
                            </div>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $user->name ?? ''}}" required disabled>
                        </div>
                    </div>


                    <div class="col-md-6 mb-3">
                        <div class="input-group">
                            <div class=input-group-append">
                                <button class="btn btn-secondary editButtons">edit</button>
                            </div>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') ?? $user->last_name ?? ''}}" placeholder="last name" required disabled>
                        </div>
                    </div>
                </div>

                {{-- email --}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-secondary editButtons" aria-describedby="email">Edit</button>
                    </div>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="email" value="{{ $user->email ?? old('email') ?? ''}}" disabled required>
                </div>

                {{-- password --}}
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary editButtons" aria-describedby="oldPassword">Edit</button>
                            </div>
                            <input type="password" class="form-control" id="oldPassword" name="oldPassword" value="{{ old('oldPassword') }}" aria-describedby="oldPassword" autocomplete="off" placeholder=" old password" disabled required>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-secondary editButtons" aria-describedby="oldPassword">Edit</button>
                            </div>   
                            <input type="password" class="form-control" id="newPassword" name="newPassword" value="{{ old('newPassword') }}" autocomplete="off" placeholder="new password" disabled required>
                        </div>
                    </div>
                </div>

                {{-- image --}}
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="profileImage" name="file" accept="image/*">
                    <label class="custom-file-label"
                        for="profileImage" aria-describedby="size">{{ isset($user->image) ? 'change profile image' : 'select profile image' }}</label>
                    <small id="size" class="form-text text-muted"> recomended size: width = 640 and heigth = 426</small>
                </div>

                <input type="hidden" name="user" value="{{ $user->id }}">
                <button class="btn btn-primary mt-3" id="update" type="submit">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        let updateButtom = document.querySelector('#update');
        let editButtons = document.querySelectorAll('.editButtons');
        updateButtonEvent();
        editButtonsEvent();


        function updateButtonEvent(){
            updateButtom.addEventListener('click', (event) => {
                console.log('enviando');
            });
        }

        function editButtonsEvent(){
            editButtons.forEach((button)=> {
                button.addEventListener('click', (eve)=>{
                    eve.preventDefault();
                    let disabledState = eve.target.parentNode.nextElementSibling;
                    if(disabledState.disabled){
                        disabledState.disabled = false;
                    }else{
                        disabledState.disabled = true;
                    }
                });
            });
        }
    </script>
@endpush
