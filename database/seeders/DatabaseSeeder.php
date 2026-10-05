<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Kullanıcı',
            'email' => 'admin@teknoloji.com',
            'password' => Hash::make('12345678'),
        ]);

        // Kategorileri Oluştur
        $categoriesData = [
            'Bilgisayar & Laptop',
            'Telefon & Tablet',
            'Ses & Kulaklık',
            'Akıllı Saat & Aksesuar',
            'Oyun & Konsol',
            'Kamera & Drone',
            'Monitör & Çevre Birimleri',
        ];

        $categories = [];
        foreach ($categoriesData as $catName) {
            $categories[$catName] = Category::create([
                'name' => $catName,
                'slug' => Str::slug($catName),
            ]);
        }

        $products = [
            // --- 💻 BİLGİSAYAR & LAPTOP ---
            [
                'category_id' => $categories['Bilgisayar & Laptop']->id,
                'name' => 'MacBook Pro 16 M3 Max',
                'description' => 'Apple M3 Max çip, 36GB RAM, 1TB SSD, 16 inç Liquid Retina XDR ekran.',
                'price' => 124999.00,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=800&q=80',
            ],
            [
                'category_id' => $categories['Bilgisayar & Laptop']->id,
                'name' => 'Asus ROG Strix G16 Oyuncu Laptopu',
                'description' => 'Intel Core i9 13980HX, RTX 4070, 32GB RAM, 1TB SSD, 240Hz ROG Nebula Ekran.',
                'price' => 74999.00,
                'stock' => 14,
                'image' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?w=800&q=80',
            ],
            [
                'category_id' => $categories['Bilgisayar & Laptop']->id,
                'name' => 'Dell XPS 15 Oled Ultrabook',
                'description' => 'Intel i7-13700H, 16GB RAM, 512GB SSD, 3.5K OLED Dokunmatik Ekran.',
                'price' => 62999.00,
                'stock' => 10,
                'image' => 'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=800&q=80',
            ],
            [
                'category_id' => $categories['Bilgisayar & Laptop']->id,
                'name' => 'Lenovo Legion 5 Pro Gaming',
                'description' => 'AMD Ryzen 7 7745HX, RTX 4060, 16GB RAM, 1TB SSD, 165Hz WQXGA.',
                'price' => 54999.00,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=800&q=80',
            ],
            [
                'category_id' => $categories['Bilgisayar & Laptop']->id,
                'name' => 'MacBook Air 13 M2',
                'description' => '8GB Unified Memory, 256GB SSD, Gece Yarısı Rengi, Ultra İnce Tasarım.',
                'price' => 38999.00,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?w=800&q=80',
            ],

            // --- 📱 TELEFON & TABLET ---
            [
                'category_id' => $categories['Telefon & Tablet']->id,
                'name' => 'iPhone 15 Pro Max 256GB',
                'description' => 'Titanyum tasarım, A17 Pro çip, 48 MP Ana kamera ve USB-C bağlantısı.',
                'price' => 84999.00,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=800&q=80',
            ],
            [
                'category_id' => $categories['Telefon & Tablet']->id,
                'name' => 'Samsung Galaxy S24 Ultra 512GB',
                'description' => 'Galaxy AI yapay zeka özellikleri, S-Pen dahili, 200MP kamera, Titanyum Gri.',
                'price' => 73999.00,
                'stock' => 18,
                'image' => 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?w=800&q=80',
            ],
            [
                'category_id' => $categories['Telefon & Tablet']->id,
                'name' => 'iPad Air M2 11 inç 128GB',
                'description' => 'Apple M2 çip, Liquid Retina ekran, Apple Pencil Pro desteği.',
                'price' => 25999.00,
                'stock' => 20,
                'image' => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=800&q=80',
            ],
            [
                'category_id' => $categories['Telefon & Tablet']->id,
                'name' => 'Samsung Galaxy Tab S9 Ultra 14.6"',
                'description' => 'Dynamic AMOLED 2X ekran, Snapdragon 8 Gen 2, S-Pen kutu dahil.',
                'price' => 34999.00,
                'stock' => 12,
                'image' => 'https://images.unsplash.com/photo-1561154464-82e9adf32764?w=800&q=80',
            ],
            [
                'category_id' => $categories['Telefon & Tablet']->id,
                'name' => 'Xiaomi 14 Ultra 512GB',
                'description' => 'Leica dörtlü kamera sistemi, Snapdragon 8 Gen 3, 90W kablosuz şarj.',
                'price' => 59999.00,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=800&q=80',
            ],

            // --- 🎧 SES & KULAKLIK ---
            [
                'category_id' => $categories['Ses & Kulaklık']->id,
                'name' => 'Sony WH-1000XM5 Kulak Üstü Kulaklık',
                'description' => 'Sektör lideri gürültü engelleme, 30 saat pil ömrü ve kristal netliğinde ses.',
                'price' => 14499.00,
                'stock' => 40,
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&q=80',
            ],
            [
                'category_id' => $categories['Ses & Kulaklık']->id,
                'name' => 'AirPods Pro 2. Nesil USB-C',
                'description' => 'Aktif Gürültü Engelleme, Şeffaf Mod, Adaptif Ses ve Dokunmatik Denetim.',
                'price' => 8499.00,
                'stock' => 45,
                'image' => 'https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?w=800&q=80',
            ],
            [
                'category_id' => $categories['Ses & Kulaklık']->id,
                'name' => 'Sennheiser Momentum 4 Wireless',
                'description' => '60 saate kadar pil ömrü, audiophile düzeyinde ses kalitesi.',
                'price' => 12999.00,
                'stock' => 15,
                'image' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=800&q=80',
            ],
            [
                'category_id' => $categories['Ses & Kulaklık']->id,
                'name' => 'Anker Soundcore Motion+ Bluetooth Hoparlör',
                'description' => '30W Hi-Res kablosuz ses kalitesi, IPX7 su geçirmezlik.',
                'price' => 3799.00,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=800&q=80',
            ],
            [
                'category_id' => $categories['Ses & Kulaklık']->id,
                'name' => 'JBL PartyBox 110 Kablosuz Hoparlör',
                'description' => '160W güçlü JBL Original Pro Ses, dinamik ışık şovu, IPX4.',
                'price' => 15999.00,
                'stock' => 8,
                'image' => 'https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?w=800&q=80',
            ],

            // --- ⌚ AKILLI SAAT & AKSESUAR ---
            [
                'category_id' => $categories['Akıllı Saat & Aksesuar']->id,
                'name' => 'Apple Watch Series 9 GPS 45mm',
                'description' => 'S9 SiP çip, Çift Dokunma hareketi, daha parlak ekran ve sağlık takibi.',
                'price' => 17999.00,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800&q=80',
            ],
            [
                'category_id' => $categories['Akıllı Saat & Aksesuar']->id,
                'name' => 'Samsung Galaxy Watch 6 Classic 47mm',
                'description' => 'Dönen çelik çerçeve, gelişmiş uyku takibi, EKG ve tansiyon ölçümü.',
                'price' => 9999.00,
                'stock' => 22,
                'image' => 'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?w=800&q=80',
            ],
            [
                'category_id' => $categories['Akıllı Saat & Aksesuar']->id,
                'name' => 'Apple Watch Ultra 2 Titanyum 49mm',
                'description' => '3000 nit aşırı parlak ekran, 36 saat normal pil ömrü, hassas çift frekanslı GPS.',
                'price' => 39999.00,
                'stock' => 10,
                'image' => 'https://images.unsplash.com/photo-1434493789847-2f02dc6ca35d?w=800&q=80',
            ],
            [
                'category_id' => $categories['Akıllı Saat & Aksesuar']->id,
                'name' => 'Anker MagGo 10.000mAh Powerbank',
                'description' => 'MagSafe uyumlu kablosuz şarj standlı powerbank, Katlanabilir ayak.',
                'price' => 2499.00,
                'stock' => 60,
                'image' => 'https://images.unsplash.com/photo-1609592424074-27f12e2b7e9b?w=800&q=80',
            ],
            [
                'category_id' => $categories['Akıllı Saat & Aksesuar']->id,
                'name' => 'Belkin 3\'ü 1 Arada MagSafe Şarj İstasyonu',
                'description' => 'iPhone, Apple Watch ve AirPods için tek noktadan hızlı şarj.',
                'price' => 4999.00,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?w=800&q=80',
            ],

            // --- 🎮 OYUN & KONSOL ---
            [
                'category_id' => $categories['Oyun & Konsol']->id,
                'name' => 'PlayStation 5 Digital Edition',
                'description' => 'Ultra yüksek hızlı SSD, DualSense kablosuz kontrol cihazı ve 4K oyun deneyimi.',
                'price' => 22999.00,
                'stock' => 8,
                'image' => 'https://images.unsplash.com/photo-1606813907291-d86efa9b94db?w=800&q=80',
            ],
            [
                'category_id' => $categories['Oyun & Konsol']->id,
                'name' => 'Xbox Series X 1TB',
                'description' => '12 Teraflop grafik işlem gücü, 4K oyun, 120 FPS desteği ve 1TB Özel SSD.',
                'price' => 23999.00,
                'stock' => 9,
                'image' => 'https://images.unsplash.com/photo-1621259182978-fbf93132d53d?w=800&q=80',
            ],
            [
                'category_id' => $categories['Oyun & Konsol']->id,
                'name' => 'Nintendo Switch OLED Model',
                'description' => '7 inç canli OLED ekran, geniş ayarlanabilir stant, 64GB dahili depolama.',
                'price' => 13499.00,
                'stock' => 16,
                'image' => 'https://images.unsplash.com/photo-1578303512597-81e6cc155b3e?w=800&q=80',
            ],
            [
                'category_id' => $categories['Oyun & Konsol']->id,
                'name' => 'Sony DualSense Edge Kablosuz Kontrol Cihazı',
                'description' => 'Özelleştirilebilir tuşlar, değiştirilebilir modüller ve arka butonlar.',
                'price' => 7999.00,
                'stock' => 30,
                'image' => 'https://images.unsplash.com/photo-1592840496694-26d035b52b48?w=800&q=80',
            ],
            [
                'category_id' => $categories['Oyun & Konsol']->id,
                'name' => 'Meta Quest 3 128GB VR Gözlük',
                'description' => 'Karma gerçeklik gözlüğü, Touch Plus kumandalar, 4K+ Sonsuz Ekran.',
                'price' => 21999.00,
                'stock' => 11,
                'image' => 'https://images.unsplash.com/photo-1622979135225-d2ba269bc1bd?w=800&q=80',
            ],

            // --- 📸 KAMERA & DRONE ---
            [
                'category_id' => $categories['Kamera & Drone']->id,
                'name' => 'DJI Mini 4 Pro Drone',
                'description' => '4K/60fps HDR video, Engel Algılama, 34 dakika uçuş süresi.',
                'price' => 38999.00,
                'stock' => 10,
                'image' => 'https://images.unsplash.com/photo-1527977966376-1c8408f9f108?w=800&q=80',
            ],
            [
                'category_id' => $categories['Kamera & Drone']->id,
                'name' => 'Canon EOS R6 Mark II Mirrorless Kamera',
                'description' => '24.2 MP tam kare sensör, 4K 60p video, Dual Pixel CMOS AF II.',
                'price' => 89999.00,
                'stock' => 6,
                'image' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=800&q=80',
            ],
            [
                'category_id' => $categories['Kamera & Drone']->id,
                'name' => 'GoPro HERO12 Black Aksiyon Kamerası',
                'description' => '5.3K video kaydı, HyperSmooth 6.0 stabilizasyon, 10m su geçirmez.',
                'price' => 16499.00,
                'stock' => 18,
                'image' => 'https://images.unsplash.com/photo-1565849904461-04a58ad377e0?w=800&q=80',
            ],
            [
                'category_id' => $categories['Kamera & Drone']->id,
                'name' => 'Sony Alpha A7 IV Kit 28-70mm Lens',
                'description' => '33 MP Tam Kare Exmor R sensör, 4K 60p kaydı, 759 odak noktası.',
                'price' => 94999.00,
                'stock' => 5,
                'image' => 'https://images.unsplash.com/photo-1512790182412-b19e6d62bc39?w=800&q=80',
            ],
            [
                'category_id' => $categories['Kamera & Drone']->id,
                'name' => 'DJI Osmo Pocket 3 VLOG Kamerası',
                'description' => '1 inç CMOS sensör, 4K/120fps, 2 inç dönebilen dokunmatik ekran.',
                'price' => 24999.00,
                'stock' => 14,
                'image' => 'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?w=800&q=80',
            ],

            // --- 🖥️ MONİTÖR & ÇEVRE BİRİMLERİ ---
            [
                'category_id' => $categories['Monitör & Çevre Birimleri']->id,
                'name' => 'Samsung Odyssey G7 27" 240Hz Monitör',
                'description' => '1ms tepkime süresi, QLED panel, 1000R kavisli ekran ve G-Sync.',
                'price' => 19499.00,
                'stock' => 12,
                'image' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=800&q=80',
            ],
            [
                'category_id' => $categories['Monitör & Çevre Birimleri']->id,
                'name' => 'Logitech MX Master 3S Kablosuz Mouse',
                'description' => '8000 DPI Quiet Clicks sessiz tıklama, MagSpeed kaydırma.',
                'price' => 4299.00,
                'stock' => 50,
                'image' => 'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?w=800&q=80',
            ],
            [
                'category_id' => $categories['Monitör & Çevre Birimleri']->id,
                'name' => 'Mekanik Oyuncu Klavyesi RGB',
                'description' => 'Cherry MX Red switch, tam boy alüminyum gövde ve RGB aydınlatma.',
                'price' => 3199.00,
                'stock' => 35,
                'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=800&q=80',
            ],
            [
                'category_id' => $categories['Monitör & Çevre Birimleri']->id,
                'name' => 'LG UltraGear 34" Curved OLED Monitör',
                'description' => '240Hz yenileme hızı, 0.03ms tepkime süresi, WQHD çözünürlük.',
                'price' => 45999.00,
                'stock' => 7,
                'image' => 'https://images.unsplash.com/photo-1547082299-de196ea013d6?w=800&q=80',
            ],
            [
                'category_id' => $categories['Monitör & Çevre Birimleri']->id,
                'name' => 'Razer BlackShark V2 Pro Kablosuz Kulaklık',
                'description' => 'HyperClear Süper Geniş Bant Mik, TriForce Titanyum 50mm sürücüler.',
                'price' => 6799.00,
                'stock' => 22,
                'image' => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?w=800&q=80',
            ],
        ];

        foreach ($products as $product) {
            $product['slug'] = Str::slug($product['name']);
            Product::create($product);
        }
    }
}