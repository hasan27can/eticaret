<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödeme Yap - TeknoMağaza</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 antialiased">

    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('products.index') }}" class="text-2xl font-extrabold text-indigo-600">TeknoMağaza</a>
            <div class="flex items-center space-x-6 text-sm font-semibold">
                <a href="{{ route('cart.index') }}" class="hover:text-indigo-600">Sepete Dön</a>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Teslimat & Ödeme Bilgileri</h1>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Adres & İletişim Formu -->
                <div class="bg-white p-6 rounded-xl shadow md:col-span-2 space-y-4">
                    <h2 class="font-bold text-lg border-b pb-2 text-gray-700">1. Teslimat Adresi</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Ad Soyad</label>
                            <input type="text" name="name" required placeholder="Ahmet Yılmaz" class="w-full border rounded-lg p-2.5 text-sm focus:outline-indigo-600">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">E-Posta</label>
                            <input type="email" name="email" required placeholder="ahmet@example.com" class="w-full border rounded-lg p-2.5 text-sm focus:outline-indigo-600">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Telefon</label>
                        <input type="text" name="phone" required placeholder="0555 123 45 67" class="w-full border rounded-lg p-2.5 text-sm focus:outline-indigo-600">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Teslimat Adresi</label>
                        <textarea name="address" rows="3" required placeholder="Mahalle, Sokak, No, İl/İlçe" class="w-full border rounded-lg p-2.5 text-sm focus:outline-indigo-600"></textarea>
                    </div>

                    <h2 class="font-bold text-lg border-b pb-2 pt-4 text-gray-700">2. Kart ile Ödeme</h2>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Kart Üzerindeki İsim</label>
                        <input type="text" name="card_name" required placeholder="AHMET YILMAZ" class="w-full border rounded-lg p-2.5 text-sm focus:outline-indigo-600">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Kart Numarası</label>
                        <input type="text" name="card_number" required placeholder="0000 0000 0000 0000" maxlength="19" class="w-full border rounded-lg p-2.5 text-sm focus:outline-indigo-600">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">Son Kullanma (AA/YY)</label>
                            <input type="text" name="card_expiry" required placeholder="12/28" class="w-full border rounded-lg p-2.5 text-sm focus:outline-indigo-600">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">CVC / CVC2</label>
                            <input type="text" name="card_cvc" required placeholder="123" maxlength="4" class="w-full border rounded-lg p-2.5 text-sm focus:outline-indigo-600">
                        </div>
                    </div>
                </div>

                <!-- Sipariş Özet Paneli -->
                <div class="bg-white p-6 rounded-xl shadow h-fit space-y-4">
                    <h2 class="font-bold text-lg border-b pb-2 text-gray-700">Sipariş Özeti</h2>

                    @php $total = 0; @endphp
                    <div class="divide-y text-xs text-gray-600">
                        @foreach($cart as $item)
                            @php $total += $item['price'] * $item['quantity']; @endphp
                            <div class="py-2 flex justify-between">
                                <span>{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                                <span class="font-semibold text-gray-800">₺{{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t pt-3 flex justify-between items-center">
                        <span class="font-bold text-gray-700">Toplam:</span>
                        <span class="font-extrabold text-xl text-indigo-600">₺{{ number_format($total, 2, ',', '.') }}</span>
                    </div>

                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-lg text-sm transition mt-4">
                        Siparişi Onayla & Öde
                    </button>
                </div>

            </div>
        </form>
    </main>

</body>
</html>