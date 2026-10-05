<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Sepet Sayfası
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Ürün Ekleme / Adet Artırma
    public function add($id)
    {
        $products = [
            1 => [
                'id' => 1,
                'name' => 'MacBook Pro 16 M3 Max',
                'description' => 'Apple M3 Max çip, 36GB RAM, 1TB SSD, 16 inç Liquid Retina XDR ekran.',
                'price' => 124999.00,
                'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=800&q=80',
                'badge' => 'Çok Satan'
            ],
            2 => [
                'id' => 2,
                'name' => 'Asus ROG Strix G16 Oyuncu Laptopu',
                'description' => 'Intel Core i9 13980HX, RTX 4070, 32GB RAM, 1TB SSD, 240Hz ROG Nebula Ekran.',
                'price' => 74999.00,
                'image' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?auto=format&fit=crop&w=800&q=80',
                'badge' => 'Fırsat Ürünü'
            ],
            3 => [
                'id' => 3,
                'name' => 'Dell XPS 15 OLED Ultrabook',
                'description' => 'Intel i7-13700H, 16GB RAM, 512GB SSD, 3.5K OLED Dokunmatik Ekran.',
                'price' => 62999.00,
                'image' => 'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?auto=format&fit=crop&w=800&q=80',
                'badge' => 'İndirimde'
            ],
            4 => [
                'id' => 4,
                'name' => 'Lenovo Legion 5 Pro Gaming',
                'description' => 'AMD Ryzen 7 7745HX, RTX 4060, 16GB RAM, 1TB SSD, 165Hz WQXGA.',
                'price' => 54999.00,
                'image' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?auto=format&fit=crop&w=800&q=80',
                'badge' => 'Yeni'
            ]
        ];

        if (!isset($products[$id])) {
            return redirect()->back()->with('error', 'Ürün bulunamadı.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id' => $products[$id]['id'],
                'name' => $products[$id]['name'],
                'quantity' => 1,
                'price' => $products[$id]['price'],
                'image' => $products[$id]['image']
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Ürün sepete eklendi!');
    }

    // Tek Tek Adet Düşürme (Eksi Butonu)
    public function decrement($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]);
            }
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Sepet güncellendi.');
    }

    // Ürünü Tamamen Silme (Çöp Kutusu Butonu)
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Ürün sepetten çıkarıldı.');
    }

    // Ödeme Sayfası Görünümü
    public function checkoutView()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Sepetiniz boş.');
        }

        return view('cart.checkout', compact('cart'));
    }

    // Siparişi Onaylama İşlemi (Sepeti Temizler ve Bildirim Gönderir)
    public function processCheckout(Request $request)
    {
        // Sepeti temizliyoruz
        session()->forget('cart');

        // Ana sayfaya sipariş tamamlandı bildirimiyle yönlendiriyoruz
        return redirect()->route('products.index')->with('success', 'Siparişiniz başarıyla alındı! Teşekkür ederiz.');
    }
}