<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\hasBoughtProducts;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Products $product)
    {
        $user = Auth::user()->id;

        // 0 means false
        if ($product->available === 0) {
            Cart::where('product_id', $product->id)->delete();

            return redirect('/')->with('error', 'Product has already been purched');
        }

        $productInCart = Cart::where('product_id', $product->id)->where('user_id', $user)->get();

        if (count($productInCart) !== 0) {
            return redirect('/')->with('error', 'Product already in cart!');
        }

        Cart::create([
            'product_id' => $product->id,
            'user_id' => $user,
        ]);

        return redirect('/')->with('message', 'Product added to cart');
    }

    public function show()
    {
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->get();

        return view('products.cart', [
            'carts' => $carts,
        ]);
    }

    public function remove(Products $product)
    {
        $cart = Cart::where('product_id', $product->id);
        if (count($cart->get()) !== 0) {
            $cart->delete();

            return redirect(route('show-cart'))->with('deleted', 'Product deleted from cart');
        }

        return redirect(route('show-cart'))->with('error', 'Product already has been purched');
    }

    public function buyCart()
    {
        $user = Auth::user();

        $sumAllProducts = (int) $user->cart->reduce(function ($carry, $productMoney) {
            return $carry + $productMoney->product->price;
        }, 0);

        if ($sumAllProducts > (int) $user->money) {
            return redirect()->back()->with('error', 'You do not have enough money to buy everything');
        }

        $user->cart->each(function ($cartProduct) use ($user) {
            // create a record in the table hasBoughtProduct
            hasBoughtProducts::create([
                'user_id' => $user->id,
                'product_id' => $cartProduct->product->id,
            ]);

            $cartProduct->product->user()->increment('money', $cartProduct->product->price);
            $user->decrement('money', $cartProduct->product->price);

            Cart::where('product_id', $cartProduct->product->id)->delete();

            $cartProduct->product->update(['available' => false]);
        });

        return redirect('/')->with('message', 'Products purched!');
    }
}
