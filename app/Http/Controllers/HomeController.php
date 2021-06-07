<?php

namespace App\Http\Controllers;

use App\Models\Products;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Products::where('available', true)->orderBy('created_at', 'desc')->paginate(10);

        return view('home', ['products' => $products]);
    }
}
