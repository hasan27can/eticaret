<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Önceki eski verileri temizle
        DB::table('products')->truncate();

        $products = [
            // FARE KATEGORİSİ
            [
                'name' => 'Logitech G Pro X Superlight Wireless',
                'category' => 'fare',
                'price' => 3899,
                'stock' => 12,
                'badge' => 'ÇOK SATAN',
                'image' => 'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?w=600&auto=format&fit=crop&q=80',
                'description' => '63 gramdan hafif, HERO 25K sensörlü ultra hafif profesyonel oyuncu faresi.'
            ],
            [
                'name' => 'Razer DeathAdder V3 Pro Wireless',
                'category' => 'fare',
                'price' => 4199,
                'stock' => 8,
                'badge' => 'YENİ',
                'image' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=600&auto=format&fit=crop&q=80',
                'description' => 'Ergonomik tasarım, Focus Pro 30K optik sensör ve 90 saat pil ömrü.'
            ],
            [
                'name' => 'SteelSeries Rival 3 Oyuncu Faresi',
                'category' => 'fare',
                'price' => 899,
                'stock' => 25,
                'badge' => 'FIRSAT',
                'image' => 'https://images.unsplash.com/photo-1626218174358-7769486c4b79?w=600&auto=format&fit=crop&q=80',
                'description' => 'TrueMove Core optik sensör, RGB Prism aydınlatma ve 60 milyon tık ömrü.'
            ],

            // KLAVYE KATEGORİSİ
            [
                'name' => 'Keychron K2 V2 Kablosuz Mekanik Klavye',
                'category' => 'klavye',
                'price' => 3299,
                'stock' => 10,
                'badge' => 'MAC/WIN',
                'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=600&auto=format&fit=crop&q=80',
                'description' => 'Mac ve Windows uyumlu, Gateron Brown switch kompakt mekanik klavye.'
            ],
            [
                'name' => 'Custom RGB Mekanik Oyuncu Klavyesi',
                'category' => 'klavye',
                'price' => 2799,
                'stock' => 5,
                'badge' => 'POPÜLER',
                'image' => 'https://images.unsplash.com/photo-1595225476474-87563907a212?w=600&auto=format&fit=crop&q=80',
                'description' => 'Özel hot-swappable tuş anahtarları ve dinamik RGB aydınlatma.'
            ],

            // KABLOLU KULAKLIK KATEGORİSİ
            [
                'name' => 'HyperX Cloud II 7.1 Oyuncu Kulaklığı',
                'category' => 'kablolu-kulaklik',
                'price' => 2299,
                'stock' => 14,
                'badge' => 'EFSANE',
                'image' => 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?w=600&auto=format&fit=crop&q=80',
                'description' => 'Hafızalı köpük kulak yastıkları, donanım tabanlı 7.1 sanal surround ses.'
            ],
            [
                'name' => 'Audio-Technica ATH-M50x Stüdyo Kulaklığı',
                'category' => 'kablolu-kulaklik',
                'price' => 4899,
                'stock' => 7,
                'badge' => 'STÜDYO',
                'image' => 'https://images.unsplash.com/photo-1583394838336-acd977736f90?w=600&auto=format&fit=crop&q=80',
                'description' => 'Profesyonel stüdyo monitör kulaklığı, net ses ayrıştırma kalitesi.'
            ],

            // KABLOSUZ KULAKLIK KATEGORİSİ
            [
                'name' => 'Sony WH-1000XM5 Bluetooth Kulaklık',
                'category' => 'kablosuz-kulaklik',
                'price' => 11499,
                'stock' => 6,
                'badge' => 'ANC LİDERİ',
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&auto=format&fit=crop&q=80',
                'description' => 'Gelişmiş gürültü engelleme (ANC) teknolojisi ve kristal netliğinde ses.'
            ],
            [
                'name' => 'Apple AirPods Pro (2. Nesil)',
                'category' => 'kablosuz-kulaklik',
                'price' => 8499,
                'stock' => 20,
                'badge' => 'APPLE',
                'image' => 'https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?w=600&auto=format&fit=crop&q=80',
                'description' => 'H2 çip, geliştirilmiş Aktif Gürültü Engelleme ve Şeffaf Mod.'
            ],
            [
                'name' => 'Sennheiser Momentum 4 Wireless',
                'category' => 'kablosuz-kulaklik',
                'price' => 10299,
                'stock' => 8,
                'badge' => '60 SAAT PİL',
                'image' => 'https://images.unsplash.com/photo-1545127398-14699f92334b?w=600&auto=format&fit=crop&q=80',
                'description' => '60 saate varan muazzam pil ömrü ve üstün ses performansı.'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}