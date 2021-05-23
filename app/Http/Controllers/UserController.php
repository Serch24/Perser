<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
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
        $products = $user->uploadProducts()->get();

        return view('user.show', ['user' => $user, 'products' => $products]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        return view('user.edit',['user' => $user]);
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
            'name'          => ['required','string'],
            'email'         => ['required'],
            'last_name'     => ['string','nullable'],
            'oldPassword'   => ['nullable'],
            'newPassword'   => ['nullable', Password::min('8')->mixedCase()],
            'file'          => ['image' , 'dimensions:min_width=320,min_height=320']
        ]);

        // get the user in the input hidden
        $user = User::find($request->user);

        if(!Hash::check($request->input('oldPassword'), $user->password )){
            return Redirect::back()->withErrors(['The old password is incorrect']);
        }

        $url = null;
        if($request->file('file') !== null){
            $img_url = $request->file('file')->store('public/imagenes/profile');
            $url = Storage::url($img_url);
        }

        User::where('id', $request->user)->update(['name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'last_name' => $request->input('last_name'),
                        'password' => Hash::make($request->input('newPassword')),
                        'profile_image' => $url
                    ]);

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
