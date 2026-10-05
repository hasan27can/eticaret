<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorilerim - TeknoMağaza</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 antialiased">

    <!-- Navbar -->
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-extrabold text-indigo-600 tracking-wide flex items-center gap-2">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
                TeknoMağaza
            </a>
            
            <div class="flex items-center space-x-6">
                <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-indigo-600 font-semibold flex items-center">
                    <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Sepetim
                </a>
                <a href="/" class="text-indigo-600 hover:underline font-semibold">← Mağazaya Dön</a>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-6 flex items-center gap-2">
            ❤️ Favorilerim
        </h1>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($wishlists as $item)
                @if($item->product)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden flex flex-col justify-between border border-gray-200">
                        <div>
                            <a href="{{ route('products.show', $item->product->id) }}">
                                <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-full h-48 object-cover hover:scale-105 transition duration-300">
                            </a>
                            <div class="p-4">
                                <a href="{{ route('products.show', $item->product->id) }}" class="block font-bold text-lg text-gray-800 hover:text-indigo-600 transition truncate">
                                    {{ $item->product->name }}
                                </a>
                                <p class="text-xs text-gray-500 line-clamp-2 mt-1">
                                    {{ $item->product->description }}
                                </p>
                            </div>
                        </div>

                        <div class="p-4 pt-0">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-xl font-bold text-indigo-600">₺{{ number_format($item->product->price, 2) }}</span>
                            </div>
                            <div class="flex gap-2">
                                <form action="{{ route('cart.add', $item->product->id) }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold py-2 rounded-lg transition">
                                        Sepete Ekle
                                    </button>
                                </form>
                                <form action="{{ route('wishlist.toggle', $item->product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-600 text-xs font-bold p-2 rounded-lg transition" title="Favorilerden Çıkar">
                                        ❌
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-xl border border-gray-200">
                    <p class="text-gray-500 font-medium">Henüz favorilere eklenmiş bir ürün yok.</p>
                    <a href="/" class="mt-4 inline-block bg-indigo-600 text-white font-bold px-4 py-2 rounded-lg text-sm">Alışverişe Başla</a>
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>