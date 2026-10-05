<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilim - TeknoMağaza</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 antialiased">

    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('products.index') }}" class="text-2xl font-extrabold text-indigo-600">TeknoMağaza</a>
            <div class="flex items-center space-x-6 text-sm font-semibold">
                <a href="{{ route('products.index') }}" class="hover:text-indigo-600">Ürünler</a>
                <a href="{{ route('cart.index') }}" class="hover:text-indigo-600">Sepetim</a>
                <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 font-bold hover:underline">Admin Paneli</a>
                <a href="{{ route('logout') }}" class="text-red-600 hover:underline">Çıkış Yap</a>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 py-8">
        <!-- Kullanıcı Bilgi Kartı -->
        <div class="bg-white p-6 rounded-xl shadow mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-800">{{ $user['name'] }}</h1>
                <p class="text-xs text-gray-500">{{ $user['email'] }}</p>
            </div>
            <span class="bg-indigo-100 text-indigo-700 text-xs font-bold px-3 py-1 rounded-full">Müşteri Hesabı</span>
        </div>

        <!-- Geçmiş Siparişler -->
        <h2 class="text-lg font-bold mb-4">Geçmiş Siparişlerim</h2>

        @if(empty($userOrders))
            <div class="bg-white p-8 rounded-xl shadow text-center">
                <p class="text-gray-500 text-sm">Henüz hiç sipariş vermediniz.</p>
                <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-indigo-600 text-white text-xs font-bold py-2 px-4 rounded-lg">Alışverişe Başla</a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($userOrders as $order)
                    <div class="bg-white p-6 rounded-xl shadow">
                        <div class="flex justify-between items-center border-b pb-3 mb-3">
                            <div>
                                <span class="font-bold text-sm text-indigo-600">Sipariş #{{ $order['id'] }}</span>
                                <span class="text-xs text-gray-400 block">{{ $order['date'] }}</span>
                            </div>
                            @php
                                $status = $order['status'] ?? 'Hazırlanıyor';
                            @endphp
                            <span class="text-xs font-bold px-2.5 py-1 rounded-md
                                @if($status == 'Teslim Edildi') bg-emerald-100 text-emerald-700
                                @elseif($status == 'Kargoda') bg-blue-100 text-blue-700
                                @else bg-amber-100 text-amber-700 @endif">
                                {{ $status }}
                            </span>
                        </div>

                        <div class="divide-y text-xs">
                            @foreach($order['items'] as $item)
                                <div class="py-2 flex justify-between items-center">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $item['image'] }}" class="w-10 h-10 object-cover rounded">
                                        <span>{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                                    </div>
                                    <span class="font-semibold">₺{{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t pt-3 mt-3 flex justify-between items-center font-bold text-sm">
                            <span>Toplam Tutar:</span>
                            <span class="text-indigo-600">₺{{ number_format($order['total_price'], 2, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

</body>
</html>