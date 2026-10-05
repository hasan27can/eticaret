<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public static function all($columns = ['*'])
    {
        $defaultProducts = collect([
            (object)[
                'id' => 1,
                'name' => 'MacBook Pro 16 M3 Max',
                'description' => 'Apple M3 Max çip, 36GB RAM, 1TB SSD, 16 inç Liquid Retina XDR ekran.',
                'price' => 124999.00,
                'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=600&auto=format&fit=crop&q=80',
                'badge' => 'Çok Satan',
                'category' => 'Apple'
            ],
            (object)[
                'id' => 2,
                'name' => 'Asus ROG Strix G16 Oyuncu Laptopu',
                'description' => 'Intel Core i9 13980HX, RTX 4070, 32GB RAM, 1TB SSD, 240Hz ROG Nebula Ekran.',
                'price' => 74999.00,
                'image' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?w=600&auto=format&fit=crop&q=80',
                'badge' => 'Fırsat Ürünü',
                'category' => 'Gaming'
            ],
            (object)[
                'id' => 3,
                'name' => 'Dell XPS 15 Oled Ultrabook',
                'description' => 'Intel i7-13700H, 16GB RAM, 512GB SSD, 3.5K OLED Dokunmatik Ekran.',
                'price' => 62999.00,
                'image' => 'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=600&auto=format&fit=crop&q=80',
                'badge' => 'İndirimde',
                'category' => 'Ultrabook'
            ],
            (object)[
                'id' => 4,
                'name' => 'Lenovo Legion 5 Pro Gaming',
                'description' => 'AMD Ryzen 7 7745HX, RTX 4060, 16GB RAM, 1TB SSD, 165Hz WQXGA.',
                'price' => 54999.00,
                'image' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=600&auto=format&fit=crop&q=80',
                'badge' => 'Yeni',
                'category' => 'Gaming'
            ],
            (object)[
                'id' => 5,
                'name' => 'MacBook Air 13 M2',
                'description' => 'Apple M2 çip, 8GB RAM, 256GB SSD, Gece Yarısı Siyahı, İnce ve Hafif Tasarım.',
                'price' => 39999.00,
                'image' => 'https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?w=600&auto=format&fit=crop&q=80',
                'badge' => 'Çok Satan',
                'category' => 'Apple'
            ],
            (object)[
                'id' => 6,
                'name' => 'MSI Katana 15 Gaming Laptop',
                'description' => 'Intel Core i7 13620H, RTX 4050, 16GB RAM, 512GB SSD, 144Hz FHD Ekran.',
                'price' => 42999.00,
                'image' => 'https://images.unsplash.com/photo-1544731612-de7f96afe55f?w=600&auto=format&fit=crop&q=80',
                'badge' => 'Fırsat Ürünü',
                'category' => 'Gaming'
            ]
        ]);

        $customProducts = collect(session()->get('custom_products', []));

        return $defaultProducts->merge($customProducts);
    }

    public static function findOrFail($id)
    {
        $product = static::all()->firstWhere('id', $id);
        if (!$product) {
            abort(404);
        }
        return $product;
    }
}