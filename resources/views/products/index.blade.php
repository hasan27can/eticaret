<!DOCTYPE html>
<html lang="tr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ürün Kataloğu - TeknoMağaza</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>

    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        /* Scrollbar Gizleme */
        .scrollbar-none::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-none {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col justify-between antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Navbar -->
    <header class="bg-slate-900/80 backdrop-blur-md border-b border-slate-800/80 sticky top-0 z-50 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Logo & Marka -->
            <a href="{{ route('products.index') }}" class="flex items-center space-x-3 group">
                <div class="w-11 h-11 bg-gradient-to-tr from-indigo-600 to-violet-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-indigo-500/25 group-hover:scale-105 transition duration-300">
                    <i class="fa-solid fa-layer-group text-xl"></i>
                </div>
                <div>
                    <span class="text-xl font-extrabold tracking-tight bg-gradient-to-r from-white via-slate-200 to-slate-400 bg-clip-text text-transparent block">
                        TeknoMağaza
                    </span>
                    <span class="text-[10px] text-slate-400 font-semibold tracking-wider uppercase block -mt-1">
                        Geleceğin Teknolojileri
                    </span>
                </div>
            </a>

            <!-- Arama Barı (Desktop Header) -->
            <div class="hidden md:flex items-center flex-1 max-w-md mx-8">
                <form action="{{ route('products.index') }}" method="GET" class="w-full relative">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Ürün adı, marka veya özellik ara..." 
                           class="w-full bg-slate-950/60 border border-slate-800 rounded-2xl pl-11 pr-10 py-2.5 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-200">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                    @if(request('search'))
                        <a href="{{ route('products.index', request()->except('search')) }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-300 transition">
                            <i class="fa-solid fa-xmark text-sm"></i>
                        </a>
                    @endif
                </form>
            </div>

            <!-- Sağ Butonlar -->
            <div class="flex items-center space-x-2 sm:space-x-3">
                <!-- Admin Kontrol Butonu -->
                <a href="/products/create" class="bg-amber-500/10 hover:bg-amber-500/20 text-amber-400 border border-amber-500/30 px-3.5 py-2.5 rounded-2xl text-sm font-semibold transition flex items-center space-x-2 group shadow-sm">
                    <i class="fa-solid fa-user-shield group-hover:scale-110 transition duration-200"></i>
                    <span class="hidden lg:inline">Admin Kontrol</span>
                </a>

                <!-- Favoriler Butonu -->
                <a href="/favorites" class="relative bg-slate-800/80 hover:bg-slate-800 text-slate-200 px-3.5 py-2.5 rounded-2xl text-sm font-semibold transition border border-slate-700/60 flex items-center space-x-2 shadow-sm group">
                    <i class="fa-solid fa-heart text-rose-500 group-hover:scale-110 transition duration-200"></i>
                    <span class="hidden sm:inline">Favoriler</span>
                    @if(count(session()->get('favorites', [])) > 0)
                        <span class="bg-rose-500 text-white text-[11px] font-bold px-2 py-0.5 rounded-full">
                            {{ count(session()->get('favorites', [])) }}
                        </span>
                    @endif
                </a>

                <!-- Sepetim Butonu -->
                <a href="/cart" class="relative bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2.5 rounded-2xl text-sm font-semibold transition shadow-lg shadow-indigo-600/30 flex items-center space-x-2 group">
                    <i class="fa-solid fa-cart-shopping group-hover:scale-110 transition duration-200"></i>
                    <span class="hidden sm:inline">Sepetim</span>
                    @if(count(session()->get('cart', [])) > 0)
                        <span class="bg-white text-indigo-600 text-[11px] font-extrabold px-2 py-0.5 rounded-full">
                            {{ count(session()->get('cart', [])) }}
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </header>

    <!-- Ana İçerik -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-1 w-full">

        <!-- Mobil Arama Barı -->
        <div class="md:hidden mb-6">
            <form action="{{ route('products.index') }}" method="GET" class="w-full relative">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if(request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       placeholder="Ürün ara..." 
                       class="w-full bg-slate-900 border border-slate-800 rounded-2xl pl-11 pr-10 py-3 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-indigo-500">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
            </form>
        </div>

        <!-- Bildirim Mesajları -->
        @if(session('success'))
            <div class="mb-6 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-4 py-3 rounded-2xl flex items-center justify-between shadow-lg backdrop-blur-sm">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-circle-check text-lg"></i>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-200">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-rose-500/10 border border-rose-500/30 text-rose-400 px-4 py-3 rounded-2xl flex items-center justify-between shadow-lg backdrop-blur-sm">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-400 hover:text-rose-200">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        <!-- Banner / Başlık Alanı -->
        <div class="relative bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 mb-8 overflow-hidden shadow-2xl">
            <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10 max-w-2xl">
                <span class="text-indigo-400 text-xs font-bold uppercase tracking-widest bg-indigo-500/10 border border-indigo-500/20 px-3 py-1 rounded-full inline-block mb-3">
                    Özel Teknoloji Koleksiyonu
                </span>
                <h1 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight mb-2">
                    En Yeni Ekipmanları Keşfet
                </h1>
                <p class="text-slate-400 text-sm sm:text-base leading-relaxed">
                    Performansınızı artıracak premium kulaklık, klavye, fare ve oyuncu ekipmanlarında kaçırılmayacak fırsatlar.
                </p>
            </div>
        </div>

        <!-- Filtreleme ve Kategori Barları -->
        <div class="space-y-4 mb-8">
            <!-- Kategoriler -->
            <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none">
                <a href="{{ route('products.index', request()->except('category')) }}" 
                   class="px-4 py-2.5 rounded-2xl text-sm font-semibold whitespace-nowrap transition border {{ !request('category') || request('category') == 'all' ? 'bg-indigo-600 border-indigo-500 text-white shadow-lg shadow-indigo-600/20' : 'bg-slate-900 border-slate-800 text-slate-400 hover:text-slate-200 hover:border-slate-700' }}">
                    <i class="fa-solid fa-border-all mr-2"></i> Tümü
                </a>

                @php
                    $categoryIcons = [
                        'fare' => 'fa-mouse',
                        'klavye' => 'fa-keyboard',
                        'kablolu-kulaklik' => 'fa-headphones',
                        'kablosuz-kulaklik' => 'fa-headphones-simple',
                        'akilli-saat' => 'fa-stopwatch',
                        'dizustu-bilgisayar' => 'fa-laptop'
                    ];

                    $categoryNames = [
                        'fare' => 'Fare',
                        'klavye' => 'Klavye',
                        'kablolu-kulaklik' => 'Kablolu Kulaklık',
                        'kablosuz-kulaklik' => 'Kablosuz Kulaklık',
                        'akilli-saat' => 'Akıllı Saat',
                        'dizustu-bilgisayar' => 'Dizüstü Bilgisayar'
                    ];
                @endphp

                @foreach($categoryNames as $key => $name)
                    <a href="{{ route('products.index', array_merge(request()->query(), ['category' => $key])) }}" 
                       class="px-4 py-2.5 rounded-2xl text-sm font-semibold whitespace-nowrap transition border {{ request('category') == $key ? 'bg-indigo-600 border-indigo-500 text-white shadow-lg shadow-indigo-600/20' : 'bg-slate-900 border-slate-800 text-slate-400 hover:text-slate-200 hover:border-slate-700' }}">
                        <i class="fa-solid {{ $categoryIcons[$key] ?? 'fa-tag' }} mr-2"></i> {{ $name }}
                    </a>
                @endforeach
            </div>

            <!-- Sıralama ve Sonuç Sayısı Barı -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-slate-900/50 border border-slate-800/80 p-4 rounded-2xl">
                <div class="text-sm text-slate-400 font-medium">
                    Toplam <span class="text-white font-bold">{{ count($products) }}</span> ürün listeleniyor
                </div>

                <form action="{{ route('products.index') }}" method="GET" class="flex items-center space-x-3 w-full sm:w-auto">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <span class="text-xs text-slate-500 uppercase font-bold whitespace-nowrap">SIRALA:</span>
                    <select name="sort" onchange="this.form.submit()" class="bg-slate-950 border border-slate-800 text-slate-300 text-sm rounded-xl px-3 py-2 focus:outline-none focus:border-indigo-500 w-full sm:w-auto">
                        <option value="">Varsayılan</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Fiyat: Düşükten Yükseğe</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Fiyat: Yüksekten Düşüğe</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- Ürün Kartları Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($products as $product)
                @php
                    $isFavorite = in_array(data_get($product, 'id', 0), session()->get('favorites', []));
                @endphp
                
                <div class="bg-slate-900 border border-slate-800 hover:border-slate-700 rounded-3xl p-4 flex flex-col justify-between transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/10 group relative">
                    
                    <!-- Görsel & Rozet Alanı -->
                    <div class="relative w-full h-52 bg-slate-950/80 rounded-2xl p-4 flex items-center justify-center overflow-hidden mb-4 border border-slate-800/50">
                        @if(data_get($product, 'badge'))
                            <span class="absolute top-3 left-3 bg-rose-500/90 text-white text-[10px] font-extrabold uppercase px-2.5 py-1 rounded-lg z-10 shadow-md">
                                {{ data_get($product, 'badge') }}
                            </span>
                        @endif

                        <!-- Favori Butonu -->
                        <a href="{{ route('favorites.toggle', data_get($product, 'id', 1)) }}" 
                           class="absolute top-3 right-3 w-9 h-9 bg-slate-900/80 hover:bg-slate-800 border border-slate-700/80 rounded-xl flex items-center justify-center text-slate-400 hover:text-rose-500 transition z-10 backdrop-blur-sm">
                            <i class="fa-{{ $isFavorite ? 'solid text-rose-500' : 'regular' }} fa-heart text-sm"></i>
                        </a>

                        <!-- Ürün Görseli -->
                        <a href="{{ route('products.show', data_get($product, 'id', 1)) }}" class="w-full h-full flex items-center justify-center">
                            <img src="{{ data_get($product, 'image') ?? data_get($product, 'image_url') ?? 'https://images.unsplash.com/photo-1560617544-b4f2b77a9826?w=600&auto=format&fit=crop&q=80' }}" 
                                 alt="{{ data_get($product, 'name') }}" 
                                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1560617544-b4f2b77a9826?w=600&auto=format&fit=crop&q=80';"
                                 class="max-h-full max-w-full object-contain group-hover:scale-105 transition duration-300 rounded-lg">
                        </a>
                    </div>

                    <!-- Ürün Bilgileri -->
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <div class="text-[11px] font-bold text-indigo-400 uppercase tracking-wider mb-1">
                                {{ $categoryNames[data_get($product, 'category')] ?? data_get($product, 'category') }}
                            </div>
                            <h3 class="font-bold text-slate-100 text-base mb-2 group-hover:text-indigo-400 transition line-clamp-1" title="{{ data_get($product, 'name') }}">
                                <a href="{{ route('products.show', data_get($product, 'id', 1)) }}">{{ data_get($product, 'name') }}</a>
                            </h3>
                            <p class="text-xs text-slate-400 line-clamp-2 mb-4 leading-relaxed">
                                {{ data_get($product, 'description') ?? 'Yüksek kaliteli teknolojik ürün.' }}
                            </p>
                        </div>

                        <!-- Fiyat ve Sepet Butonu -->
                        <div class="pt-3 border-t border-slate-800/80 flex items-center justify-between gap-2">
                            <div>
                                <span class="text-xs text-slate-500 block font-medium">Fiyat</span>
                                <span class="text-lg font-extrabold text-white">
                                    {{ number_format(data_get($product, 'price', 0), 0, ',', '.') }} ₺
                                </span>
                            </div>

                            @if(data_get($product, 'stock', 1) > 0)
                                <form action="{{ route('cart.add', data_get($product, 'id', 1)) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-indigo-600/10 hover:bg-indigo-600 border border-indigo-500/30 hover:border-indigo-600 text-indigo-400 hover:text-white px-3.5 py-2.5 rounded-xl text-xs font-bold transition flex items-center space-x-1.5 shadow-sm">
                                        <i class="fa-solid fa-cart-plus text-sm"></i>
                                        <span>Ekle</span>
                                    </button>
                                </form>
                            @else
                                <span class="text-[11px] bg-slate-800 text-slate-500 font-bold px-3 py-2 rounded-xl border border-slate-700/50">
                                    Tükendi
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
            @empty
                <!-- Boş Durum -->
                <div class="col-span-full py-16 text-center">
                    <div class="w-20 h-20 bg-slate-900 border border-slate-800 rounded-3xl flex items-center justify-center mx-auto mb-4 text-slate-600">
                        <i class="fa-solid fa-box-open text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-200 mb-1">Ürün Bulunamadı</h3>
                    <p class="text-slate-500 text-sm mb-6">Arama kriterlerinize uygun ürün bulunamadı.</p>
                    <a href="{{ route('products.index') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition inline-flex items-center space-x-2">
                        <i class="fa-solid fa-rotate-left"></i>
                        <span>Filtreleri Temizle</span>
                    </a>
                </div>
            @endforelse
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 border-t border-slate-800 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-center md:text-left">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-indigo-600 rounded-xl flex items-center justify-center text-white text-sm font-bold">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <span class="text-sm font-bold text-slate-300">TeknoMağaza © 2026</span>
                </div>
                <div class="flex items-center space-x-6 text-xs text-slate-400">
                    <a href="#" class="hover:text-slate-200 transition">Gizlilik Politikası</a>
                    <a href="#" class="hover:text-slate-200 transition">Kullanım Şartları</a>
                    <a href="#" class="hover:text-slate-200 transition">Destek</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>