<!DOCTYPE HTML>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favori Ürünlerim - TeknoMağaza</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .product-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .product-card:hover {
            transform: translateY(-6px);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col justify-between selection:bg-indigo-500 selection:text-white">

    <!-- Navbar Section -->
    <header class="bg-white/90 backdrop-blur-md border-b border-gray-200/80 sticky top-0 z-50 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            
            <!-- Logo -->
            <a href="{{ route('products.index') }}" class="flex items-center space-x-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center text-white shadow-md shadow-indigo-200 group-hover:scale-105 transition">
                    <i class="fa-solid fa-laptop-code text-lg"></i>
                </div>
                <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-700">TeknoMağaza</span>
            </a>

            <!-- Right Actions -->
            <div class="flex items-center space-x-3 sm:space-x-6">
                <a href="{{ route('products.index') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition flex items-center space-x-2">
                    <i class="fa-solid fa-store text-gray-400 group-hover:text-indigo-600"></i>
                    <span class="hidden sm:inline">Tüm Ürünler</span>
                </a>

                <div class="h-4 w-px bg-gray-200"></div>

                <a href="{{ route('favorites.index') }}" class="relative p-2 text-red-500 hover:text-red-600 transition">
                    <i class="fa-solid fa-heart text-2xl"></i>
                    @php
                        $favList = $favoriteProducts ?? $favorites ?? [];
                    @endphp
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[11px] font-extrabold rounded-full w-5 h-5 flex items-center justify-center border-2 border-white shadow-sm">
                        {{ count($favList) }}
                    </span>
                </a>
            </div>
        </div>
    </header>

    <!-- Page Content Container -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex-grow w-full">

        <!-- Breadcrumb & Top Bar -->
        <nav class="flex text-xs font-medium text-gray-400 mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('products.index') }}" class="hover:text-indigo-600 transition">Anasayfa</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fa-solid fa-chevron-right text-[10px] mx-1 text-gray-300"></i>
                        <span class="text-gray-700 font-semibold">Favorilerim</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-6 mb-8 border-b border-gray-200 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight flex items-center gap-3">
                    <span class="p-2 bg-red-50 text-red-500 rounded-xl inline-flex items-center justify-center">
                        <i class="fa-solid fa-heart text-2xl"></i>
                    </span>
                    Favori Ürünlerim
                </h1>
                <p class="text-gray-500 text-sm mt-1">Kaydettiğiniz tüm favori ürünler tek bir yerde listelenir.</p>
            </div>

            @if(count($favList) > 0)
                <div class="flex items-center gap-3">
                    <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-3 py-1.5 rounded-full border border-gray-200">
                        Toplam <strong class="text-indigo-600">{{ count($favList) }}</strong> Ürün
                    </span>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-indigo-600 hover:text-indigo-700 bg-indigo-50 px-3 py-1.5 rounded-full transition">
                        <i class="fa-solid fa-plus"></i> Ürün Ekle
                    </a>
                </div>
            @endif
        </div>

        <!-- Success Flash Message -->
        @if(session('success'))
            <div id="flash-message" class="mb-8 p-4 bg-emerald-50 border border-emerald-200/80 text-emerald-800 rounded-2xl flex items-center justify-between shadow-sm">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-emerald-500 text-white rounded-xl flex items-center justify-center shadow-sm">
                        <i class="fa-solid fa-check text-sm"></i>
                    </div>
                    <span class="font-semibold text-sm">{{ session('success') }}</span>
                </div>
                <button onclick="document.getElementById('flash-message').remove()" class="text-emerald-500 hover:text-emerald-700 p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
        @endif

        <!-- Product Grid / Empty State -->
        @if(count($favList) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($favList as $product)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl product-card overflow-hidden flex flex-col justify-between group">
                        
                        <!-- Upper Block -->
                        <div>
                            <!-- Image Container -->
                            <div class="relative w-full h-52 overflow-hidden bg-gray-100">
                                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                
                                <!-- Toggle Favorite Button -->
                                <a href="{{ route('favorites.toggle', $product['id']) }}" class="absolute top-3 right-3 w-9 h-9 bg-white/90 backdrop-blur-md rounded-full flex items-center justify-center text-red-500 shadow-md hover:bg-red-500 hover:text-white transition duration-200">
                                    <i class="fa-solid fa-heart text-base"></i>
                                </a>

                                <!-- Badge -->
                                @if(isset($product['badge']))
                                    <span class="absolute top-3 left-3 bg-gray-900/80 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-lg uppercase tracking-wider">
                                        {{ $product['badge'] }}
                                    </span>
                                @endif
                            </div>

                            <!-- Details -->
                            <div class="p-5">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-[11px] font-bold text-indigo-600 uppercase tracking-wider bg-indigo-50 px-2.5 py-1 rounded-md">
                                        {{ $product['category'] ?? 'Teknoloji' }}
                                    </span>
                                    <span class="text-[11px] text-emerald-600 font-semibold flex items-center gap-1">
                                        <i class="fa-solid fa-truck-fast text-[10px]"></i> Ücretsiz Kargo
                                    </span>
                                </div>

                                <h3 class="text-base font-bold text-gray-900 group-hover:text-indigo-600 transition line-clamp-1">
                                    {{ $product['name'] }}
                                </h3>

                                <p class="text-gray-500 text-xs mt-2 line-clamp-2 leading-relaxed">
                                    {{ $product['description'] }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="px-5 pb-5 pt-3 border-t border-gray-100/80 flex items-center justify-between mt-auto">
                            <div>
                                <span class="text-[10px] font-medium text-gray-400 block uppercase tracking-wider">Fiyat</span>
                                <span class="text-lg font-extrabold text-gray-900">
                                    {{ number_format($product['price'], 2, ',', '.') }} ₺
                                </span>
                            </div>

                            <a href="{{ route('products.show', $product['id']) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 px-3.5 py-2 rounded-xl transition shadow-sm shadow-indigo-200">
                                <span>İncele</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty Favorites Area -->
            <div class="bg-white rounded-3xl p-12 text-center max-w-lg mx-auto shadow-sm border border-gray-100 my-12">
                <div class="w-20 h-20 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center mx-auto mb-5 text-3xl">
                    <i class="fa-regular fa-heart"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Henüz Favoriniz Yok</h2>
                <p class="text-gray-500 text-sm mb-6">Beğendiğiniz ürünleri favorilerinize ekleyerek daha sonra kolayca bulabilirsiniz.</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-3 rounded-xl transition shadow-lg shadow-indigo-200 text-sm">
                    <i class="fa-solid fa-store"></i> Ürünleri Keşfet
                </a>
            </div>
        @endif

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center space-x-2 text-sm text-gray-500">
                <i class="fa-solid fa-laptop-code text-indigo-600 text-base"></i>
                <span class="font-bold text-gray-700">TeknoMağaza</span>
                <span>&copy; {{ date('Y') }} Tüm Hakları Saklıdır.</span>
            </div>
            <div class="flex space-x-6 text-sm font-medium text-gray-500">
                <a href="#" class="hover:text-indigo-600 transition">Gizlilik Politikası</a>
                <a href="#" class="hover:text-indigo-600 transition">Kullanım Şartları</a>
                <a href="#" class="hover:text-indigo-600 transition">İletişim</a>
            </div>
        </div>
    </footer>

</body>
</html>