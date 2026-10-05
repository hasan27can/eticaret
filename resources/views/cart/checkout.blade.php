<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siparişi Tamamla - TeknoMağaza</title>
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
                <a href="{{ route('cart.index') }}" class="hover:text-indigo-600">Sepetim</a>
            </div>
        </div>
    </header>

    <!-- İçerik -->
    <main class="max-w-4xl mx-auto px-4 py-8 flex-1 w-full">
        <h1 class="text-2xl font-black text-slate-900 mb-6 tracking-tight">Siparişi Tamamla</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Form Alanı -->
            <div class="md:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <h2 class="text-base font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-truck-fast text-indigo-600"></i> Teslimat Bilgileri
                </h2>

                <form action="{{ route('cart.processCheckout') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-1">Ad</label>
                            <input type="text" name="first_name" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs font-medium focus:outline-none focus:border-indigo-500" placeholder="Ahmet" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-1">Soyad</label>
                            <input type="text" name="last_name" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs font-medium focus:outline-none focus:border-indigo-500" placeholder="Yılmaz" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1">E-Posta</label>
                        <input type="email" name="email" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs font-medium focus:outline-none focus:border-indigo-500" placeholder="ahmet@example.com" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1">Teslimat Adresi</label>
                        <textarea name="address" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs font-medium focus:outline-none focus:border-indigo-500" placeholder="Açık adresinizi yazınız..." required></textarea>
                    </div>

                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs py-3 rounded-xl transition shadow-sm mt-4">
                        Siparişi Onayla ve Bitir
                    </button>
                </form>
            </div>

            <!-- Sipariş Özeti -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 h-fit">
                <h2 class="text-base font-bold text-slate-800 mb-4">Sipariş Özetiniz</h2>
                <div class="divide-y divide-slate-100 mb-4">
                    @php $grandTotal = 0; @endphp
                    @foreach($cart as $details)
                        @php 
                            $itemTotal = $details['price'] * $details['quantity']; 
                            $grandTotal += $itemTotal;
                        @endphp
                        <div class="py-2.5 flex justify-between items-center text-xs">
                            <div>
                                <p class="font-bold text-slate-700">{{ $details['name'] }}</p>
                                <span class="text-slate-400">Adet: {{ $details['quantity'] }}</span>
                            </div>
                            <span class="font-bold text-slate-800">₺{{ number_format($itemTotal, 2, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-slate-100 pt-4 flex justify-between items-center">
                    <span class="text-xs font-bold text-slate-500">Toplam Tutarlar:</span>
                    <span class="text-lg font-black text-indigo-600">₺{{ number_format($grandTotal, 2, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </main>

</body>
</html> 