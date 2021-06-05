<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Products;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getJsonProductComments(Request $request, Products $product)
    {
        Comments::create([
            'comment' => $request->input('comment'),
            'product_id' => $product->id,
            'user_id' => $request->input('user_id'),
        ]);

        // get all comments of this product in json format
        $allComments = Comments::where('product_id', $product->id)->orderBy('created_at', 'desc')->get();

        // get users name for each comment
        $allUsers = collect([]);
        $allComments->each(function ($comment) use ($allUsers) {
            $allUsers->push($comment->user->name);
        });

        return response()->json([
            'message' => 'ok',
            'comments' => $allComments,
            'users' => $allUsers,
        ]);
    }
}
