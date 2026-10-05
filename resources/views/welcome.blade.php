<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'E-Ticaret') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Header / Navbar -->
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-bold text-xl text-indigo-600 flex items-center gap-2">
                🛒 E-Ticaret
            </a>

            <div class="flex items-center gap-6 text-sm font-medium">
                <a href="{{ route('cart.index') }}" class="hover:text-indigo-600 flex items-center gap-1">
                    🛒 Sepetim
                </a>
                <a href="{{ route('favorites.index') }}" class="hover:text-indigo-600 flex items-center gap-1">
                    ❤️ Favorilerim
                </a>

                @auth
                    <a href="{{ route('orders.index') }}" class="hover:text-indigo-600">Siparişlerim</a>
                    <a href="{{ url('/dashboard') }}" class="hover:text-indigo-600 font-semibold">Panel</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-indigo-600">Giriş Yap</a>
                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-3 py-1.5 rounded-lg hover:bg-indigo-700 transition">Kayıt Ol</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Öne Çıkan Ürünler</h1>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        <!-- Ürünler Izgarası -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition border border-gray-100 flex flex-col justify-between p-4 relative">
                    
                    <!-- Favori Butonu -->
                    <div class="absolute top-6 right-6 z-20">
                        <form action="{{ route('favorites.store', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="p-2 bg-white/90 rounded-full shadow text-gray-400 hover:text-red-500 transition border border-gray-100" title="Favorilere Ekle">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                </svg>
                            </button>
                        </form>
                    </div>

                    @php
                        $imagePath = 'https://via.placeholder.com/300';
                        if ($product->image) {
                            if (\Illuminate\Support\Str::startsWith($product->image, ['http://', 'https://'])) {
                                $imagePath = $product->image;
                            } elseif (file_exists(public_path($product->image))) {
                                $imagePath = asset($product->image);
                            } else {
                                $imagePath = asset('storage/' . $product->image);
                            }
                        }
                    @endphp

                    <div>
                        <!-- Tıklanabilir Görsel (Detay Sayfası) -->
                        <a href="{{ route('products.show', $product->id) }}" class="block mb-3 overflow-hidden rounded-xl bg-gray-50">
                            <img src="{{ $imagePath }}" alt="{{ $product->name }}" class="w-full h-48 object-cover hover:scale-105 transition duration-300">
                        </a>

                        <!-- Tıklanabilir Başlık (Detay Sayfası) -->
                        <h2 class="font-bold text-gray-800 text-base mb-1 line-clamp-1 hover:text-indigo-600">
                            <a href="{{ route('products.show', $product->id) }}">
                                {{ $product->name }}
                            </a>
                        </h2>

                        <p class="text-xs text-gray-500 line-clamp-2 mb-2">{{ $product->description }}</p>

                        <!-- Değerlendirme -->
                        <div class="flex items-center gap-1 mb-4 text-amber-400 text-xs font-semibold">
                            <div class="flex">
                                @php $rating = round($product->reviews_avg_rating ?? 5); @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $rating ? 'text-amber-400 fill-current' : 'text-gray-300 fill-current' }}" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-gray-500 text-xs font-normal">({{ $product->reviews_count ?? 0 }} değerlendirme)</span>
                        </div>
                    </div>

                    <!-- Fiyat & Sepete Ekle -->
                    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                        <span class="text-lg font-extrabold text-indigo-600">
                            ₺{{ number_format($product->price, 2, ',', '.') }}
                        </span>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold py-2 px-4 rounded-xl transition">
                                Sepete Ekle
                            </button>
                        </form>
                    </div>

                </div>
            @endforeach
        </div>

    </main>

</body>
</html>