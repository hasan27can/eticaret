<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepetim - TeknoMağaza</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-100 text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('products.index') }}" class="text-xl font-black text-indigo-600 tracking-tight flex items-center gap-2">
                TeknoMağaza
            </a>
            <div class="flex items-center gap-4 text-xs font-bold text-slate-600">
                <a href="{{ route('products.index') }}" class="hover:text-indigo-600">Ürünler</a>
                <a href="{{ route('favorites.index') }}" class="hover:text-indigo-600">Favorilerim</a>
            </div>
        </div>
    </header>

    <!-- Bildirimler -->
    <div class="max-w-4xl mx-auto w-full px-4 mt-6">
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-300 text-emerald-700 px-4 py-3 rounded-xl flex items-center gap-2 text-xs font-bold shadow-sm">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-rose-50 border border-rose-300 text-rose-700 px-4 py-3 rounded-xl flex items-center gap-2 text-xs font-bold shadow-sm">
                <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- İçerik -->
    <main class="max-w-4xl mx-auto px-4 py-8 flex-1 w-full">
        <h1 class="text-2xl font-black text-slate-900 mb-6 tracking-tight">Alışveriş Sepetim</h1>

        @if(count($cart) > 0)
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <div class="divide-y divide-slate-100">
                    @php $grandTotal = 0; @endphp
                    @foreach($cart as $id => $details)
                        @php 
                            $itemTotal = $details['price'] * $details['quantity']; 
                            $grandTotal += $itemTotal;
                        @endphp
                        <div class="py-4 flex items-center justify-between gap-4 first:pt-0 last:pb-0">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-xl bg-slate-50 border border-slate-200 p-2 flex items-center justify-center flex-shrink-0">
                                    <img src="{{ $details['image'] ?? 'https://via.placeholder.com/150' }}" alt="{{ $details['name'] }}" class="max-h-full max-w-full object-contain">
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-800 text-sm">{{ $details['name'] }}</h3>
                                    <p class="text-xs text-slate-400 mt-0.5">Birim Fiyat: ₺{{ number_format($details['price'], 2, ',', '.') }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-6">
                                <!-- Adet Değiştirme Butonları -->
                                <div class="flex items-center bg-slate-100 rounded-lg p-1 text-xs font-bold">
                                    <a href="{{ route('cart.decrement', $id) }}" class="w-7 h-7 flex items-center justify-center bg-white rounded-md shadow-sm hover:bg-slate-200 transition text-slate-600">
                                        -
                                    </a>
                                    <span class="px-3 text-slate-700">Adet: {{ $details['quantity'] }}</span>
                                    <a href="{{ route('cart.add', $id) }}" class="w-7 h-7 flex items-center justify-center bg-white rounded-md shadow-sm hover:bg-slate-200 transition text-slate-600">
                                        +
                                    </a>
                                </div>

                                <div class="text-right min-w-[100px]">
                                    <span class="font-black text-indigo-600 text-sm">₺{{ number_format($itemTotal, 2, ',', '.') }}</span>
                                </div>

                                <!-- Tamamen Silme Butonu -->
                                <a href="{{ route('cart.remove', $id) }}" class="text-slate-400 hover:text-rose-600 transition p-1" title="Sepetten Çıkar">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-slate-100 mt-6 pt-6 flex items-center justify-between">
                    <div>
                        <span class="text-xs text-slate-400 block">Genel Toplam</span>
                        <span class="text-2xl font-black text-indigo-600">₺{{ number_format($grandTotal, 2, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm px-6 py-3 rounded-xl transition shadow-sm">
                        Siparişi Tamamla →
                    </a>
                </div>
            </div>
        @else
            <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center">
                <i class="fa-solid fa-cart-shopping text-4xl text-slate-300 mb-3"></i>
                <h2 class="text-lg font-bold text-slate-700">Sepetiniz Boş</h2>
                <p class="text-xs text-slate-400 mt-1 mb-6">Sepetinizde henüz bir ürün bulunmuyor.</p>
                <a href="{{ route('products.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold px-5 py-2.5 rounded-xl transition inline-block">
                    Alışverişe Başla
                </a>
            </div>
        @endif
    </main>

</body>
</html>