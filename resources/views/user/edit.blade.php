@extends('layouts.master')
@section('body')
<div class="container">

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

    <div class="row text-center justify-content-around">
        <div class="col-3">
            <div class="w-75">
                <img src="{{$user->profile_image ?? asset('default-profile.png')}}" alt="profile image" class="img-fluid img-thumbnail">
            </div>
        </div>
        <div class="col-8">
            <form action="/profile/update" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="name">name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name ?? old('name') ?? ''}}"
                            required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last_name">Last name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                            value="{{ $user->last_name ?? old('last_name') ?? ''}}">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="name">email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email ?? old('email') ?? ''}}"
                            required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="oldPassword">old password</label>
                        <input type="password" class="form-control" id="oldPassword" name="oldPassword" value="{{ old('oldPassword') }}" autocomplete="off">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="newPassword">new password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" value="{{ old('newPassword') }}" autocomplete="off">
                    </div>
                </div>

                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="profileImage" name="file" accept="image/*">
                    <label class="custom-file-label"
                        for="profileImage">{{ isset($user->image) ? 'change profile image' : 'select profile image' }}</label>
                </div>

                <input type="hidden" name="user" value="{{ $user->id }}">
                <button class="btn btn-primary" type="submit">Update</button>
                <button class="btn btn-secondary" type="submit">cancel</button>
            </form>
        </div>
    </div>
</div>
@endsection
