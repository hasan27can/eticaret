<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $query = Wishlist::with('product');

        if (Auth::check()) {
            $wishlists = $query->where('user_id', Auth::id())->get();
        } else {
            $wishlists = $query->where('session_id', session()->getId())->get();
        }

        return view('favorites.index', compact('wishlists'));
    }

    public function toggle($productId)
    {
        $userId = Auth::id();
        $sessionId = session()->getId();

        $wishlist = Wishlist::where('product_id', $productId)
            ->where(function($q) use ($userId, $sessionId) {
                if ($userId) {
                    $q->where('user_id', $userId);
                } else {
                    $q->where('session_id', $sessionId);
                }
            })->first();

        if ($wishlist) {
            $wishlist->delete();
            return back()->with('success', 'Ürün favorilerden çıkarıldı.');
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'session_id' => $userId ? null : $sessionId,
            ]);
            return back()->with('success', 'Ürün favorilere eklendi!');
        }
    }
}