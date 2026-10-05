<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TeknoMağaza</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-100 text-slate-800 antialiased font-sans">

    <div class="min-h-screen flex">
        <!-- Sol Menü (Sidebar) -->
        <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col p-4">
            <div class="px-2 py-4 border-b border-slate-800 mb-6">
                <a href="{{ route('products.index') }}" class="text-xl font-black text-indigo-400 tracking-tight flex items-center gap-2">
                    <i class="fa-solid fa-store"></i> TeknoMağaza
                </a>
                <span class="text-[10px] uppercase font-bold text-slate-500 tracking-wider">Yönetim Paneli</span>
            </div>

            <nav class="space-y-1 flex-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-indigo-600 text-white font-bold text-xs">
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>
                <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white font-bold text-xs transition">
                    <i class="fa-solid fa-box"></i> Ürün Listesi
                </a>
            </nav>

            <div class="pt-4 border-t border-slate-800">
                <a href="{{ route('products.index') }}" class="flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-white">
                    <i class="fa-solid fa-arrow-left"></i> Sitede Gör
                </a>
            </div>
        </aside>

        <!-- Ana İçerik -->
        <main class="flex-1 p-8">
            <header class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-black text-slate-900">Yönetim Paneli Özet</h1>
                    <p class="text-xs text-slate-500 font-medium">Sistem durumunu ve özet verileri buradan takip edebilirsiniz.</p>
                </div>
            </header>

            <!-- İstatistik Kartları -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-500 mb-1">Toplam Ürün</p>
                        <h3 class="text-2xl font-black text-slate-900">12</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-box"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-500 mb-1">Toplam Sipariş</p>
                        <h3 class="text-2xl font-black text-slate-900">24</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-500 mb-1">Toplam Ciro</p>
                        <h3 class="text-2xl font-black text-slate-900">₺142.500</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>