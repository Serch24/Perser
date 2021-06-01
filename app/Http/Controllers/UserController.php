<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        $uploadProducts = $user->uploadProducts()->get();
        $purchedProducts = $user->purchedProducts()->get();

        return view('user.show', [
            'user' => $user,
            'products' => $uploadProducts,
            'purched' => $purchedProducts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'          => ['sometimes', 'required', 'string'],
            'email'         => ['sometimes', 'required'],
            'last_name'     => ['sometimes', 'string', 'nullable'],
            'oldPassword'   => ['required_with:newPassword'],
            'newPassword'   => ['required_with:oldPassword', Password::min('8')->mixedCase()],
            'file'          => ['sometimes', 'required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'dimensions:max_width=1366,max_height=768'],
        ]);

        // get the user in the input hidden
        $user = User::find($request->user);

        if ($request->has('oldPassword')) {
            if (! Hash::check($request->input('oldPassword'), $user->password)) {
                return Redirect::back()->withErrors(['The old password is incorrect']);
            }
        }

        $url = null;
        if ($request->file('file') !== null) {
            $img_url = $request->file('file')->store('public/imagenes/profile');
            $url = Storage::url($img_url);
        }

        if ($request->has('name')) {
            User::where('id', $request->user)->update(['name' => $request->input('name')]);
        }

        if ($request->has('last_name')) {
            User::where('id', $request->user)->update(['last_name' => $request->input('last_name')]);
        }

        if ($request->has('email')) {
            User::where('id', $request->user)->update(['email' => $request->input('email')]);
        }

        if ($request->has('oldPassword') && $request->has('newPassword')) {
            User::where('id', $request->user)->update(['password' => Hash::make($request->input('newPassword'))]);
        }

        if ($url !== null) {
            User::where('id', $request->user)->update(['profile_image' => $url]);
        }

        return redirect()->route('profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
