<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    private function getAllProducts()
    {
        return [
            // --- DİZÜSTÜ BİLGİSAYAR ---
            ['id' => 1, 'category' => 'dizustu-bilgisayar', 'name' => 'MacBook Pro 16 M3 Max', 'description' => 'Apple M3 Max çip, 36GB RAM, 1TB SSD, 16 inç Liquid Retina XDR ekran.', 'price' => 124999.00, 'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=500&q=80', 'badge' => 'ÇOK SATAN'],
            ['id' => 2, 'category' => 'dizustu-bilgisayar', 'name' => 'Asus ROG Strix G16 Oyuncu Laptopu', 'description' => 'Intel Core i9 13980HX, RTX 4070, 32GB RAM, 1TB SSD, 240Hz ROG Nebula Ekran.', 'price' => 74999.00, 'image' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?w=500&q=80', 'badge' => 'FIRSAT ÜRÜNÜ'],
            ['id' => 3, 'category' => 'dizustu-bilgisayar', 'name' => 'Dell XPS 15 OLED Ultrabook', 'description' => 'Intel i7-13700H, 16GB RAM, 512GB SSD, 3.5K OLED Dokunmatik Ekran.', 'price' => 62999.00, 'image' => 'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=500&q=80', 'badge' => 'İNDİRİMDE'],
            ['id' => 4, 'category' => 'dizustu-bilgisayar', 'name' => 'Lenovo Legion 5 Pro Gaming', 'description' => 'AMD Ryzen 7 7745HX, RTX 4060, 16GB RAM, 1TB SSD, 165Hz WQXGA.', 'price' => 54999.00, 'image' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=500&q=80', 'badge' => 'YENİ'],
            ['id' => 5, 'category' => 'dizustu-bilgisayar', 'name' => 'MacBook Air 15 M2', 'description' => 'Apple M2 çip, 8GB RAM, 256GB SSD, İnce ve Hafif Alüminyum Kasa.', 'price' => 44999.00, 'image' => 'https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?w=500&q=80', 'badge' => 'POPÜLER'],

            // --- TELEFON ---
            ['id' => 6, 'category' => 'telefon', 'name' => 'iPhone 15 Pro Max 256GB', 'description' => 'A17 Pro çip, Titanyum tasarım, 48 MP kamera sistemi ve Action Button.', 'price' => 84999.00, 'image' => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=500&q=80', 'badge' => 'POPÜLER'],
            ['id' => 7, 'category' => 'telefon', 'name' => 'Samsung Galaxy S24 Ultra 512GB', 'description' => 'Snapdragon 8 Gen 3, Galaxy AI, 200 MP Kamera ve Dahili S-Pen.', 'price' => 73999.00, 'image' => 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?w=500&q=80', 'badge' => 'FIRSAT ÜRÜNÜ'],
            ['id' => 8, 'category' => 'telefon', 'name' => 'Xiaomi 13 Pro 12GB/512GB', 'description' => 'Leica profesyonel optik lensler, Snapdragon 8 Gen 2, 120W HyperCharge.', 'price' => 42999.00, 'image' => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=500&q=80', 'badge' => 'YENİ'],
            ['id' => 9, 'category' => 'telefon', 'name' => 'Google Pixel 8 Pro 128GB', 'description' => 'Google Tensor G3 çip, Yapay Zeka fotoğrafçılığı ve 120Hz Smooth Display.', 'price' => 38999.00, 'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500&q=80', 'badge' => 'İNDİRİMDE'],
            ['id' => 10, 'category' => 'telefon', 'name' => 'Nothing Phone (2) 256GB', 'description' => 'Şeffaf Glyph Arayüzü, Snapdragon 8+ Gen 1, 50 MP ikili arka kamera.', 'price' => 29999.00, 'image' => 'https://images.unsplash.com/photo-1565849904461-04a58ad377e0?w=500&q=80', 'badge' => 'TREND'],

            // --- KULAKLIK ---
            ['id' => 11, 'category' => 'kulaklik', 'name' => 'Sony WH-1000XM5 Kablosuz Kulaklık', 'description' => 'Sektör lideri gürültü engelleme, 30 saat pil ömrü ve kristal netliğinde ses.', 'price' => 12999.00, 'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&q=80', 'badge' => 'İNDİRİMDE'],
            ['id' => 12, 'category' => 'kulaklik', 'name' => 'Apple AirPods Max Uzay Grisi', 'description' => 'Apple tasarımı dinamik sürücü, Aktif Gürültü Engelleme ve Şeffaf Mod.', 'price' => 24999.00, 'image' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=500&q=80', 'badge' => 'ÇOK SATAN'],
            ['id' => 13, 'category' => 'kulaklik', 'name' => 'Sennheiser Momentum 4 Wireless', 'description' => '60 saate varan efsanevi pil ömrü, hissettiren baslar ve yüksek çözünürlüklü ses.', 'price' => 14499.00, 'image' => 'https://images.unsplash.com/photo-1484704849700-f032a568e944?w=500&q=80', 'badge' => 'YENİ'],
            ['id' => 14, 'category' => 'kulaklik', 'name' => 'Bose QuietComfort Earbuds II', 'description' => 'Kişiselleştirilmiş ses kalitesi, dünyanın en etkili gürültü engelleme teknolojisi.', 'price' => 9999.00, 'image' => 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?w=500&q=80', 'badge' => 'POPÜLER'],
            ['id' => 15, 'category' => 'kulaklik', 'name' => 'SteelSeries Arctis Nova Pro Wireless', 'description' => 'Çift pil sistemi, 360° Uzamsal Ses ve aktif gürültü engelleyici oyuncu kulaklığı.', 'price' => 13999.00, 'image' => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?w=500&q=80', 'badge' => 'FIRSAT ÜRÜNÜ'],

            // --- HOPARLÖR ---
            ['id' => 16, 'category' => 'hoparlor', 'name' => 'JBL Charge 5 Bluetooth Hoparlör', 'description' => 'IP67 suya ve toza dayanıklı, 20 saat çalma süresi, dahili powerbank.', 'price' => 6499.00, 'image' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=500&q=80', 'badge' => 'FIRSAT ÜRÜNÜ'],
            ['id' => 17, 'category' => 'hoparlor', 'name' => 'Marshall Stanmore III Bluetooth Hoparlör', 'description' => 'İkonik retro tasarım, genişletilmiş ses sahnesi ve pirinç detaylar.', 'price' => 14999.00, 'image' => 'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=500&q=80', 'badge' => 'ÇOK SATAN'],
            ['id' => 18, 'category' => 'hoparlor', 'name' => 'Harman Kardon Aura Studio 3', 'description' => '360 derece ses deneyimi, kubbe tasarım ve entegre ortam ışığı efektleri.', 'price' => 11299.00, 'image' => 'https://images.unsplash.com/photo-1512446816042-444d641267d4?w=500&q=80', 'badge' => 'YENİ'],
            ['id' => 19, 'category' => 'hoparlor', 'name' => 'Sonos Move 2 Akıllı Hoparlör', 'description' => 'Stereo ses, IP56 hava koşullarına dayanıklı, Trueplay otomatik akustik ayar.', 'price' => 18499.00, 'image' => 'https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?w=500&q=80', 'badge' => 'POPÜLER'],
            ['id' => 20, 'category' => 'hoparlor', 'name' => 'Anker Soundcore Motion X600', 'description' => 'Uzamsal ses teknolojisi, 50W güç çıktısı, Hi-Res kablosuz ses desteği.', 'price' => 7999.00, 'image' => 'https://images.unsplash.com/photo-1528148343865-51218c4a13e6?w=500&q=80', 'badge' => 'İNDİRİMDE'],

            // --- FARE ---
            ['id' => 21, 'category' => 'fare', 'name' => 'Logitech MX Master 3S Kablosuz Mouse', 'description' => '8K DPI her yüzeyde takip, ultra sessiz tıklama ve ergonomik tasarım.', 'price' => 4299.00, 'image' => 'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?w=500&q=80', 'badge' => 'ÇOK SATAN'],
            ['id' => 22, 'category' => 'fare', 'name' => 'Razer DeathAdder V3 Pro Wireless', 'description' => '63g ultra hafif yapı, Focus Pro 30K optik sensör, 90 saat pil ömrü.', 'price' => 5499.00, 'image' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=500&q=80', 'badge' => 'YENİ'],
            ['id' => 23, 'category' => 'fare', 'name' => 'Logitech G Pro X Superlight 2', 'description' => 'LIGHTFORCE hibrid anahtarlar, HERO 2 sensör, profesyonel e-spor faresi.', 'price' => 5999.00, 'image' => 'https://images.unsplash.com/photo-1626218174358-7769486c4b79?w=500&q=80', 'badge' => 'POPÜLER'],
            ['id' => 24, 'category' => 'fare', 'name' => 'SteelSeries Aerox 3 Wireless', 'description' => 'Ultra hafif 68g delikli petek tasarım, AquaBarrier su/toz koruması.', 'price' => 2899.00, 'image' => 'https://images.unsplash.com/photo-1613141411244-0e4ac259d217?w=500&q=80', 'badge' => 'İNDİRİMDE'],
            ['id' => 25, 'category' => 'fare', 'name' => 'Apple Magic Mouse - Siyah', 'description' => 'Multi-Touch yüzey, şarj edilebilir pil, kablosuz Bluetooth bağlantısı.', 'price' => 3499.00, 'image' => 'https://images.unsplash.com/photo-1607677686474-ab93fc91d841?w=500&q=80', 'badge' => 'FIRSAT ÜRÜNÜ'],

            // --- KLAVYE ---
            ['id' => 26, 'category' => 'klavye', 'name' => 'Keychron K2 V2 Mekanik Klavye', 'description' => 'Kablosuz RGB Mekanik Klavye, Gateron G Pro Switch, Mac ve Windows uyumlu.', 'price' => 3899.00, 'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=500&q=80', 'badge' => 'POPÜLER'],
            ['id' => 27, 'category' => 'klavye', 'name' => 'Logitech MX Keys S Kablosuz Klavye', 'description' => 'Akıllı aydınlatma, ergonomik tuş yapısı, çoklu cihaz eşleştirme desteği.', 'price' => 4599.00, 'image' => 'https://images.unsplash.com/photo-1587829740319-6208035277f7?w=500&q=80', 'badge' => 'ÇOK SATAN'],
            ['id' => 28, 'category' => 'klavye', 'name' => 'SteelSeries Apex Pro TKL Wireless', 'description' => 'Dünyanın en hızlı OmniPoint 2.0 ayarlanabilir anahtarları, OLED akıllı ekran.', 'price' => 8999.00, 'image' => 'https://images.unsplash.com/photo-1595225476474-87563907a212?w=500&q=80', 'badge' => 'YENİ'],
            ['id' => 29, 'category' => 'klavye', 'name' => 'Asus ROG Azoth %75 Mekanik Klavye', 'description' => 'OLED ekran, conta montajlı yapı, yağlanmış ROG NX anahtarlar, hot-swap.', 'price' => 9499.00, 'image' => 'https://images.unsplash.com/photo-1511467687858-23d96c32e4ae?w=500&q=80', 'badge' => 'FIRSAT ÜRÜNÜ'],
            ['id' => 30, 'category' => 'klavye', 'name' => 'Corsair K70 RGB PRO Mekanik Klavye', 'description' => 'CHERRY MX Red anahtarlar, 8.000Hz hyper-polling hızı, alüminyum kasa.', 'price' => 5299.00, 'image' => 'https://images.unsplash.com/photo-1618384887929-16ec33fab9ef?w=500&q=80', 'badge' => 'İNDİRİMDE']
        ];
    }

    public function index()
    {
        $allProducts = $this->getAllProducts();
        $favorites = session()->get('favorites', []);

        // Favorilere eklenmiş olan ürünleri eşleştir
        $favoriteProducts = array_filter($allProducts, function ($p) use ($favorites) {
            return in_array($p['id'], $favorites);
        });

        return view('favorites.index', [
            'favoriteProducts' => array_values($favoriteProducts)
        ]);
    }

    public function toggle($id)
    {
        $id = (int)$id;
        $favorites = session()->get('favorites', []);

        if (in_array($id, $favorites)) {
            $favorites = array_filter($favorites, fn($favId) => (int)$favId !== $id);
            $message = 'Ürün favorilerden çıkarıldı!';
        } else {
            $favorites[] = $id;
            $message = 'Ürün favorilere eklendi!';
        }

        session()->put('favorites', array_values($favorites));

        return redirect()->back()->with('success', $message);
    }
}