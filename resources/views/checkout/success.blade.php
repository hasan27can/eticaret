<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Başarılı</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 antialiased">

    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('products.index') }}" class="text-2xl font-extrabold text-indigo-600">TeknoMağaza</a>
        </div>
    </nav>

    <main class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white p-8 rounded-xl shadow text-center space-y-6">
            <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto text-2xl font-bold">
                ✓
            </div>

            <div>
                <h1 class="text-2xl font-bold text-gray-800">Siparişiniz Başarıyla Alındı!</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Sipariş Kodunuz: <span class="font-bold text-indigo-600">#{{ $order['order_id'] ?? $order['id'] ?? '' }}</span>
                </p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg text-left text-xs space-y-2">
                <p><strong>Alıcı:</strong> {{ $order['customer_name'] ?? $order['name'] ?? 'Müşteri' }}</p>
                <p><strong>E-Posta:</strong> {{ $order['email'] ?? '-' }}</p>
                <p><strong>Telefon:</strong> {{ $order['phone'] ?? '-' }}</p>
                <p><strong>Teslimat Adresi:</strong> {{ $order['address'] ?? 'Belirtilmedi' }}</p>
                <p><strong>Tarih:</strong> {{ $order['date'] ?? '' }}</p>
            </div>

            <div class="border-t pt-4 text-left">
                <h3 class="font-bold text-sm mb-2">Satın Alınan Ürünler</h3>
                <div class="divide-y text-xs">
                    @if(isset($order['items']) && is_array($order['items']))
                        @foreach($order['items'] as $item)
                            <div class="py-2 flex justify-between">
                                <span>{{ $item['name'] ?? 'Ürün' }} (x{{ $item['quantity'] ?? 1 }})</span>
                                <span class="font-bold">₺{{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 2, ',', '.') }}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="border-t pt-4 flex justify-between items-center text-sm font-bold">
                <span>Toplam Tutar:</span>
                <span class="text-emerald-600 text-lg">₺{{ number_format($order['total'] ?? 0, 2, ',', '.') }}</span>
            </div>

            <div class="pt-4">
                <a href="{{ route('products.index') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2.5 rounded-lg text-sm transition">
                    Alışverişe Devam Et
                </a>
            </div>
        </div>
    </main>

</body>
</html>