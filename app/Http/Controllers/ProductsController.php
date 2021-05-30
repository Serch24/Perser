<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\hasBoughtProducts;
use App\Models\hasUploadProducts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentUser = Auth::user()->id;
        $request->validate([
            'file' => ['required', 'image' , 'mimes:jpeg,png,jpg,gif,svg', 'dimensions:max_width=641,max_height=427'],
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        $url = null;
        if($request->file('file') !== null){
            $img_url = $request->file('file')->store('public/imagenes/products');
            $url = Storage::url($img_url);
        }

        $product = Products::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image' => $url ?? null,
            'available' => true
        ]);

        hasUploadProducts::create([
            'user_id' => $currentUser,
            'product_id' => $product->id
        ]);

        return redirect()->route('home');
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Products $product)
    {
        return view('products.show', ['product' => $product]);
    }

    public function showPurched(){
        return view('products.showPurched');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $product)
    {
        return view('products.edit',['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function buy(Products $product)
    {
        return view('products.buy', ["product" => $product]);
    }

    public function cart(Products $product)
    {
        dd($product);
    }

    public function buyProduct(Request $request){
        $user = Auth::user();
        $product = Products::find($request->input('idProduct'));

        if($user->money === null || $user->money < $product->price){
            return Redirect::back()->withErrors(['You do not have enough money!']);
        }

        // create a record in the table hasBoughtProduct
        hasBoughtProducts::create([
            'user_id' => $user->id,
            'product_id' => $request->input('idProduct')
        ]);

        // update available column
        $product->update(['available' => false]);

        // increment money of the user whose upload the product
        $product->user()->increment('money', $product->price);
        $user->decrement('money', $product->price);

        return redirect('/');
    }
}
