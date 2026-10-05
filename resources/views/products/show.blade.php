<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ is_array($product) ? $product['name'] : $product->name }} - TeknoMağaza</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-50 text-slate-800 antialiased font-sans">

    @php
        $cart = session()->get('cart', []);
        $cartCount = is_array($cart) ? array_sum(array_column($cart, 'quantity')) : 0;
        $favorites = session()->get('favorites', []);
        $favCount = is_array($favorites) ? count($favorites) : 0;
        $productId = is_array($product) ? $product['id'] : $product->id;
        $isFav = is_array($favorites) && in_array($productId, $favorites);
    @endphp

    <!-- Header -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ route('products.index') }}" class="text-2xl font-black text-indigo-600 tracking-tight flex items-center gap-2">
                <i class="fa-solid fa-store"></i> TeknoMağaza
            </a>

            <div class="flex items-center gap-3">
                <a href="{{ route('cart.index') }}" class="bg-indigo-50 text-indigo-600 font-bold text-xs px-4 py-2.5 rounded-xl hover:bg-indigo-100 transition flex items-center gap-2">
                    <i class="fa-solid fa-cart-shopping"></i> Sepetim
                    <span class="bg-indigo-600 text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center font-bold ml-1">{{ $cartCount }}</span>
                </a>
                <a href="{{ route('favorites.index') }}" class="bg-rose-50 text-rose-600 font-bold text-xs px-4 py-2.5 rounded-xl hover:bg-rose-100 transition flex items-center gap-2">
                    <i class="fa-solid fa-heart"></i> Favorilerim
                    <span class="bg-rose-600 text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center font-bold ml-1">{{ $favCount }}</span>
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-indigo-600 hover:text-indigo-800 mb-6">
            <i class="fa-solid fa-arrow-left"></i> Ürün Listesine Dön
        </a>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-xl text-xs font-bold flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-base"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Ürün Bilgileri -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 lg:p-8 shadow-sm grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <div class="bg-slate-50 rounded-xl p-8 flex items-center justify-center border border-slate-100">
                <img src="{{ is_array($product) ? $product['image'] : $product->image }}" class="max-h-80 object-contain">
            </div>

            <div class="flex flex-col justify-between">
                <div>
                    @if(isset($product['badge']) || isset($product->badge))
                        <span class="bg-indigo-50 text-indigo-700 text-xs font-bold px-2.5 py-1 rounded-md">
                            {{ is_array($product) ? $product['badge'] : $product->badge }}
                        </span>
                    @endif
                    <h1 class="text-2xl font-black text-slate-900 mt-3 mb-2">
                        {{ is_array($product) ? $product['name'] : $product->name }}
                    </h1>
                    
                    <div class="flex items-center gap-2 mb-4">
                        <div class="flex text-amber-400 text-sm">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa-{{ $i <= round($avgRating ?? 0) ? 'solid' : 'regular' }} fa-star"></i>
                            @endfor
                        </div>
                        <span class="text-xs font-bold text-slate-700">{{ isset($avgRating) && $avgRating > 0 ? $avgRating : 'Değerlendirilmedi' }}</span>
                        <span class="text-xs text-slate-400">({{ count($productReviews ?? []) }} İnceleme)</span>
                    </div>

                    <p class="text-sm text-slate-600 leading-relaxed mb-6">
                        {{ is_array($product) ? $product['description'] : $product->description }}
                    </p>
                </div>

                <div>
                    <div class="text-3xl font-black text-slate-900 mb-6">
                        ₺{{ number_format(is_array($product) ? $product['price'] : $product->price, 2, ',', '.') }}
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('cart.add', $productId) }}" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm py-3.5 rounded-xl transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-cart-shopping"></i> Sepete Ekle
                        </a>
                        <a href="{{ route('favorites.toggle', $productId) }}" class="w-12 h-12 border border-slate-200 rounded-xl flex items-center justify-center transition hover:bg-rose-50 text-slate-400 hover:text-rose-500">
                            <i class="fa-{{ $isFav ? 'solid text-rose-500' : 'regular' }} fa-heart text-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- İncelemeler Bölümü -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Yorum Listesi -->
            <div class="lg:col-span-2">
                <h2 class="text-xl font-black text-slate-900 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-comments text-indigo-600"></i> Ürün İncelemeleri ({{ count($productReviews ?? []) }})
                </h2>

                @if(isset($productReviews) && count($productReviews) > 0)
                    <div class="space-y-4">
                        @foreach($productReviews as $review)
                            @php
                                $reviewName = 'Anonim Kullanıcı';

                                if (is_array($review)) {
                                    if (!empty($review['name'])) {
                                        $reviewName = $review['name'];
                                    } elseif (!empty($review['user_name'])) {
                                        $reviewName = $review['user_name'];
                                    } elseif (!empty($review['author'])) {
                                        $reviewName = $review['author'];
                                    }
                                } elseif (is_object($review)) {
                                    if (!empty($review->name)) {
                                        $reviewName = $review->name;
                                    } elseif (!empty($review->user_name)) {
                                        $reviewName = $review->user_name;
                                    } elseif (!empty($review->author)) {
                                        $reviewName = $review->author;
                                    }
                                }
                            @endphp

                            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="font-bold text-sm text-slate-900">
                                        {{ $reviewName }}
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium">
                                        {{ is_array($review) ? ($review['date'] ?? '') : ($review->date ?? '') }}
                                    </span>
                                </div>
                                <div class="flex text-amber-400 text-xs mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa-{{ $i <= (is_array($review) ? ($review['rating'] ?? 5) : ($review->rating ?? 5)) ? 'solid' : 'regular' }} fa-star"></i>
                                    @endfor
                                </div>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    {{ is_array($review) ? ($review['comment'] ?? '') : ($review->comment ?? '') }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white border border-slate-200 rounded-xl p-8 text-center text-slate-500 text-xs font-medium">
                        Bu ürün için henüz yorum yapılmadı. İlk değerlendirmeyi siz yapın!
                    </div>
                @endif
            </div>

            <!-- Yorum Yapma Formu -->
            <div>
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm sticky top-28">
                    <h3 class="text-base font-bold text-slate-900 mb-4">İnceleme Yazın</h3>

                    <form action="{{ route('products.review', $productId) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Adınız Soyadınız</label>
                            <input type="text" name="name" required class="w-full border border-slate-200 rounded-xl px-3 py-2 text-xs focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="Örn: Ahmet Yılmaz">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Puanınız</label>
                            <select name="rating" required class="w-full border border-slate-200 rounded-xl px-3 py-2 text-xs focus:ring-2 focus:ring-indigo-500 outline-none">
                                <option value="5">⭐⭐⭐⭐⭐ (5 - Mükemmel)</option>
                                <option value="4">⭐⭐⭐⭐ (4 - Çok İyi)</option>
                                <option value="3">⭐⭐⭐ (3 - Orta)</option>
                                <option value="2">⭐⭐ (2 - Kötü)</option>
                                <option value="1">⭐ (1 - Çok Kötü)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Yorumunuz</label>
                            <textarea name="comment" rows="4" required class="w-full border border-slate-200 rounded-xl px-3 py-2 text-xs focus:ring-2 focus:ring-indigo-500 outline-none resize-none" placeholder="Ürün hakkındaki düşünceleriniz..."></textarea>
                        </div>

                        <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs py-3 rounded-xl transition">
                            İncelemeyi Gönder
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>
</html>