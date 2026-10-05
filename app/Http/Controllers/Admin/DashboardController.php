<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Dosyandaki sipariş tablosu ve istatistikler için gerekli veriler
        $orders = Order::with('user')->latest()->get(); // ya da paginate(10)
        
        return view('admin_dashboard', compact('orders'));
    }
}