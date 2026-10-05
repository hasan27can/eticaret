<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerOrderController extends Controller
{
    // Müşterinin kendi siparişlerini listeleme
    public function index()
    {
        // Giriş yapmış kullanıcının e-posta adresine ait siparişleri çekiyoruz
        $orders = Order::where('email', Auth::user()->email)->latest()->get();

        return view('orders.my-orders', compact('orders'));
    }
}