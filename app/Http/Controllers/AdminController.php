<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin Ana Sayfası / Dashboard
    public function dashboard()
    {
        $products = session()->get('products', []);
        $orders = session()->get('orders', []);

        return view('admin.products.dashboard', compact('products', 'orders'));
    }

    // Yeni Ürün Ekleme İşlemi
    public function storeProduct(Request $request)
    {
        $products = session()->get('products', []);

        $newId = count($products) > 0 ? max(array_keys($products)) + 1 : 1;

        $products[$newId] = [
            'id' => $newId,
            'name' => $request->input('name', 'Yeni Ürün'),
            'price' => (float) $request->input('price', 0),
            'description' => $request->input('description', ''),
            'image' => $request->input('image', 'https://via.placeholder.com/300'),
            'badge' => $request->input('badge', '')
        ];

        session()->put('products', $products);

        return redirect()->back()->with('success', 'Yeni ürün başarıyla eklendi.');
    }

    // Ürün Silme İşlemi
    public function deleteProduct($id)
    {
        $products = session()->get('products', []);

        if (isset($products[$id])) {
            unset($products[$id]);
            session()->put('products', $products);
            return redirect()->back()->with('success', 'Ürün başarıyla silindi.');
        }

        return redirect()->back()->with('error', 'Ürün bulunamadı.');
    }

    // Sipariş Durumu Güncelleme
    public function updateOrderStatus(Request $request, $id)
    {
        $orders = session()->get('orders', []);

        if (isset($orders[$id])) {
            $orders[$id]['status'] = $request->input('status', 'Tamamlandı');
            session()->put('orders', $orders);
            return redirect()->back()->with('success', 'Sipariş durumu güncellendi.');
        }

        return redirect()->back()->with('error', 'Sipariş bulunamadı.');
    }
}