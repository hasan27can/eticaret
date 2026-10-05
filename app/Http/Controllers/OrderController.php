<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Sepetiniz boş olduğu için ödeme sayfasına gidilemez.');
        }

        return view('checkout');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'address' => 'required|string|max:500',
            'phone'   => 'required|string|max:20',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Sepetiniz boş!');
        }

        DB::beginTransaction();

        try {
            $totalAmount = 0;
            foreach ($cart as $item) {
                $totalAmount += $item['price'] * $item['quantity'];
            }

            // Siparişi oluştur ve ürünleri 'items' sütununa JSON olarak ekle
            $order = Order::create([
                'user_id'      => Auth::id(),
                'name'         => $request->name,
                'email'        => $request->email,
                'total_amount' => $totalAmount,
                'status'       => 'completed',
                'address'      => $request->address,
                'phone'        => $request->phone,
                'items'        => json_encode($cart),
            ]);

            // Stok düşürme işlemi
            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

            foreach ($cart as $id => $details) {
                if (isset($products[$id])) {
                    $product = $products[$id];
                    $product->decrement('stock', $details['quantity']);
                }
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('orders.index')->with('success', 'Siparişiniz başarıyla oluşturuldu!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Sipariş tamamlanırken bir hata oluştu: ' . $e->getMessage());
        }
    }
}