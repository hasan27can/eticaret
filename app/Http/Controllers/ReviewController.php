<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'user_name' => 'required|string|max:50',
            'rating'    => 'required|integer|min:1|max:5',
            'comment'   => 'required|string|min:5|max:1000',
        ]);

        Review::create([
            'product_id' => $productId,
            'user_name'  => $request->user_name,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        return back()->with('success', 'Yorumunuz başarıyla eklendi!');
    }
}