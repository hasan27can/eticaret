<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index');
        }

        return view('checkout.index', compact('cart'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'card_name' => 'required|string',
            'card_number' => 'required|string',
            'card_expiry' => 'required|string',
            'card_cvc' => 'required|string|max:4',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index');
        }

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        $orderId = 'TR' . rand(100000, 999999);

        $order = [
            'id' => $orderId,
            'customer_name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'items' => $cart,
            'total_price' => $totalPrice,
            'date' => date('d.m.Y H:i')
        ];

        // Siparişi sakla
        $orders = session()->get('orders', []);
        $orders[$orderId] = $order;
        session()->put('orders', $orders);

        // Sepeti temizle
        session()->forget('cart');
        session()->save();

        return redirect()->route('checkout.success', $orderId);
    }

    public function success($id)
    {
        $orders = session()->get('orders', []);

        if (!isset($orders[$id])) {
            return redirect()->route('products.index');
        }

        $order = $orders[$id];

        return view('checkout.success', compact('order'));
    }
}