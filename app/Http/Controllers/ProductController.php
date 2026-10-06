<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class ProductController extends Controller
{
    /**
     * Ana sayfa veya Ürün Kataloğu görünümü
     */
    public function index()
    {
        try {
            // 1. Veritabanı tablosu yoksa veya ürün bulunmuyorsa otomatik kurulum yap
            if (!Schema::hasTable('products') || DB::table('products')->count() === 0) {
                
                // Foreign key kilitlenme hatasını engellemek için geçici kapatıyoruz
                Schema::disableForeignKeyConstraints();
                
                // Veritabanını sıfırla ve örnek verileri yükle
                Artisan::call('migrate:fresh --seed');
                
                // Foreign key kontrollerini tekrar açıyoruz
                Schema::enableForeignKeyConstraints();

                // Sayfayı temiz bir şekilde yönlendirerek 419 session hatasını engelle
                return redirect()->route('products.index')->with('success', 'Veritabanı otomatik olarak kuruldu.');
            }

            // 2. Ürünler mevcutsa verileri çek
            $products = DB::table('products')->get();

            // Sizin view dosyanızın adı (örn: 'products.index' veya 'welcome' veya 'home')
            return view('products.index', compact('products'));

        } catch (\Exception $e) {
            // Herhangi bir veritabanı çökme hatasında sıfırlamayı güvenli çalıştır
            try {
                Schema::disableForeignKeyConstraints();
                Artisan::call('migrate:fresh --seed');
                Schema::enableForeignKeyConstraints();
                
                return redirect()->route('products.index');
            } catch (\Exception $ex) {
                return response()->json(['error' => 'Veritabanı kurulum hatası: ' . $ex->getMessage()], 500);
            }
        }
    }
}