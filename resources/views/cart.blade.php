<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepetim - TeknoMağaza</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <!-- Üst Menü / Navbar -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('products.index') }}" class="flex items-center space-x-2 text-indigo-600 text-2xl font-black">
                <i class="fa-solid fa-store"></i>
                <span>TeknoMağaza</span>
            </a>
            <div class="flex items-center space-x-4">
                <a href="{{ route('products.index') }}" class="text-sm font-semibold text-gray-600 hover:text-indigo-600">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Alışverişe Devam Et
                </a>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
            <i class="fa-solid fa-shopping-cart text-indigo-600"></i> Alışveriş Sepetim
        </h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-r">
                {{ session('success') }}
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Ürün Listesi -->
                <div class="lg:col-span-2 space-y-4">
                    @php $totalPrice = 0; @endphp
                    @foreach($cart as $id => $item)
                        @php 
                            $itemTotal = $item['price'] * $item['quantity'];
                            $totalPrice += $itemTotal;
                        @endphp
                        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex items-center gap-4">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-20 h-20 object-contain rounded-lg bg-gray-50 p-2">
                            
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800">{{ $item['name'] }}</h3>
                                <p class="text-sm text-gray-500">Birim Fiyat: ₺{{ number_format($item['price'], 2, ',', '.') }}</p>
                                
                                <div class="flex items-center gap-3 mt-2">
                                    <span class="text-xs bg-indigo-50 text-indigo-600 px-2 py-1 rounded font-bold">
                                        Adet: {{ $item['quantity'] }}
                                    </span>
                                </div>
                            </div>

                            <div class="text-right">
                                <div class="font-black text-lg text-indigo-600">
                                    ₺{{ number_format($itemTotal, 2, ',', '.') }}
                                </div>
                                <a href="{{ route('cart.remove', $id) }}" class="text-xs text-red-500 hover:underline mt-1 inline-block">
                                    <i class="fa-solid fa-trash"></i> Sil
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Sipariş Özeti -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 h-fit space-y-4">
                    <h2 class="font-bold text-lg text-gray-800 border-b pb-3">Sipariş Özeti</h2>
                    
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Ara Toplam</span>
                        <span>₺{{ number_format($totalPrice, 2, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Kargo</span>
                        <span class="text-green-600 font-semibold">Ücretsiz</span>
                    </div>

                    <div class="border-t pt-3 flex justify-between font-black text-xl text-gray-900">
                        <span>Toplam</span>
                        <span class="text-indigo-600">₺{{ number_format($totalPrice, 2, ',', '.') }}</span>
                    </div>

                    <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-indigo-200">
                        Siparişi Tamamla <i class="fa-solid fa-arrow-right ml-1"></i>
                    </button>
                    
                    <a href="{{ route('cart.clear') }}" class="block text-center text-xs text-gray-400 hover:text-red-500 mt-2">
                        Sepeti Tamamen Temizle
                    </a>
                </div>

            </div>
        @else
            <!-- Sepet Boş Görünümü -->
            <div class="bg-white rounded-2xl p-12 text-center max-w-md mx-auto shadow-sm border border-gray-100">
                <i class="fa-solid fa-basket-shopping text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Sepetiniz Boş</h3>
                <p class="text-gray-500 text-sm mb-6">Henüz sepetinize hiçbir ürün eklemediniz.</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-indigo-700 transition">
                    Ürünleri İncele
                </a>
            </div>
        @endif
    </div>

</body>
</html>