<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorilerim - TeknoMağaza</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-50 text-slate-800 antialiased font-sans">

    @php
        $cart = session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));
        $favorites = session()->get('favorites', []);
        $favCount = count($favorites);

        $allProducts = [
            1 => ['id' => 1, 'name' => 'MacBook Pro 16 M3 Max', 'description' => 'Apple M3 Max çip, 36GB RAM, 1TB SSD, 16 inç Liquid Retina XDR ekran.', 'price' => 124999.00, 'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=500&q=80'],
            2 => ['id' => 2, 'name' => 'Asus ROG Strix G16 Oyuncu Laptopu', 'description' => 'Intel Core i9 13980HX, RTX 4070, 32GB RAM, 1TB SSD, 240Hz ROG Nebula Ekran.', 'price' => 74999.00, 'image' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?w=500&q=80'],
            3 => ['id' => 3, 'name' => 'Dell XPS 15 OLED Ultrabook', 'description' => 'Intel i7-13700H, 16GB RAM, 512GB SSD, 3.5K OLED Dokunmatik Ekran.', 'price' => 62999.00, 'image' => 'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=500&q=80'],
            4 => ['id' => 4, 'name' => 'Lenovo Legion 5 Pro Gaming', 'description' => 'AMD Ryzen 7 7745HX, RTX 4060, 16GB RAM, 1TB SSD, 165Hz WQXGA.', 'price' => 54999.00, 'image' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=500&q=80'],
            5 => ['id' => 5, 'name' => 'MacBook Air 15 M2', 'description' => 'Apple M2 çip, 8GB RAM, 256GB SSD, İnce ve Hafif Alüminyum Kasa.', 'price' => 44999.00, 'image' => 'https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?w=500&q=80'],
            6 => ['id' => 6, 'name' => 'iPhone 15 Pro Max 256GB', 'description' => 'A17 Pro çip, Titanyum tasarım, 48 MP kamera sistemi ve Action Button.', 'price' => 84999.00, 'image' => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=500&q=80'],
            7 => ['id' => 7, 'name' => 'Samsung Galaxy S24 Ultra 512GB', 'description' => 'Snapdragon 8 Gen 3, Galaxy AI, 200 MP Kamera ve Dahili S-Pen.', 'price' => 73999.00, 'image' => 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?w=500&q=80'],
            8 => ['id' => 8, 'name' => 'Xiaomi 13 Pro 12GB/512GB', 'description' => 'Leica profesyonel optik lensler, Snapdragon 8 Gen 2, 120W HyperCharge.', 'price' => 42999.00, 'image' => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=500&q=80'],
            9 => ['id' => 9, 'name' => 'Google Pixel 8 Pro 128GB', 'description' => 'Google Tensor G3 çip, Yapay Zeka fotoğrafçılığı ve 120Hz Smooth Display.', 'price' => 38999.00, 'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500&q=80'],
            10 => ['id' => 10, 'name' => 'Nothing Phone (2) 256GB', 'description' => 'Şeffaf Glyph Arayüzü, Snapdragon 8+ Gen 1, 50 MP ikili arka kamera.', 'price' => 29999.00, 'image' => 'https://images.unsplash.com/photo-1565849904461-04a58ad377e0?w=500&q=80'],
            11 => ['id' => 11, 'name' => 'Sony WH-1000XM5 Kablosuz Kulaklık', 'description' => 'Sektör lideri gürültü engelleme, 30 saat pil ömrü ve kristal netliğinde ses.', 'price' => 12999.00, 'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&q=80'],
            12 => ['id' => 12, 'name' => 'Apple AirPods Max Uzay Grisi', 'description' => 'Apple tasarımı dinamik sürücü, Aktif Gürültü Engelleme ve Şeffaf Mod.', 'price' => 24999.00, 'image' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=500&q=80'],
            13 => ['id' => 13, 'name' => 'Sennheiser Momentum 4 Wireless', 'description' => '60 saate varan efsanevi pil ömrü, hissettiren baslar ve yüksek çözünürlüklü ses.', 'price' => 14499.00, 'image' => 'https://images.unsplash.com/photo-1484704849700-f032a568e944?w=500&q=80'],
            14 => ['id' => 14, 'name' => 'Bose QuietComfort Earbuds II', 'description' => 'Kişiselleştirilmiş ses kalitesi, dünyanın en etkili gürültü engelleme teknolojisi.', 'price' => 9999.00, 'image' => 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?w=500&q=80'],
            15 => ['id' => 15, 'name' => 'SteelSeries Arctis Nova Pro Wireless', 'description' => 'Çift pil sistemi, 360° Uzamsal Ses ve aktif gürültü engelleyici oyuncu kulaklığı.', 'price' => 13999.00, 'image' => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?w=500&q=80'],
            16 => ['id' => 16, 'name' => 'JBL Charge 5 Bluetooth Hoparlör', 'description' => 'IP67 suya ve toza dayanıklı, 20 saat çalma süresi, dahili powerbank.', 'price' => 6499.00, 'image' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=500&q=80'],
            17 => ['id' => 17, 'name' => 'Marshall Stanmore III Bluetooth Hoparlör', 'description' => 'İkonik retro tasarım, genişletilmiş ses sahnesi ve pirinç detaylar.', 'price' => 14999.00, 'image' => 'https://images.unsplash.com/photo-1545454675-3531b543be5d?w=500&q=80'],
            18 => ['id' => 18, 'name' => 'Harman Kardon Aura Studio 3', 'description' => '360 derece ses deneyimi, kubbe tasarım ve entegre ortam ışığı efektleri.', 'price' => 11299.00, 'image' => 'https://images.unsplash.com/photo-1512446816042-444d641267d4?w=500&q=80'],
            19 => ['id' => 19, 'name' => 'Sonos Move 2 Akıllı Hoparlör', 'description' => 'Stereo ses, IP56 hava koşullarına dayanıklı, Trueplay otomatik akustik ayar.', 'price' => 18499.00, 'image' => 'https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?w=500&q=80'],
            20 => ['id' => 20, 'name' => 'Anker Soundcore Motion X600', 'description' => 'Uzamsal ses teknolojisi, 50W güç çıktısı, Hi-Res kablosuz ses desteği.', 'price' => 7999.00, 'image' => 'https://images.unsplash.com/photo-1528148343865-51218c4a13e6?w=500&q=80'],
            21 => ['id' => 21, 'name' => 'Logitech MX Master 3S Kablosuz Mouse', 'description' => '8K DPI her yüzeyde takip, ultra sessiz tıklama ve ergonomik tasarım.', 'price' => 4299.00, 'image' => 'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?w=500&q=80'],
            22 => ['id' => 22, 'name' => 'Razer DeathAdder V3 Pro Wireless', 'description' => '63g ultra hafif yapı, Focus Pro 30K optik sensör, 90 saat pil ömrü.', 'price' => 5499.00, 'image' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=500&q=80'],
            23 => ['id' => 23, 'name' => 'Logitech G Pro X Superlight 2', 'description' => 'LIGHTFORCE hibrid anahtarlar, HERO 2 sensör, profesyonel e-spor faresi.', 'price' => 5999.00, 'image' => 'https://images.unsplash.com/photo-1626218174358-7769486c4b79?w=500&q=80'],
            24 => ['id' => 24, 'name' => 'SteelSeries Aerox 3 Wireless', 'description' => 'Ultra hafif 68g delikli petek tasarım, AquaBarrier su/toz koruması.', 'price' => 2899.00, 'image' => 'https://images.unsplash.com/photo-1613141411244-0e4ac259d217?w=500&q=80'],
            25 => ['id' => 25, 'name' => 'Apple Magic Mouse - Siyah', 'description' => 'Multi-Touch yüzey, şarj edilebilir pil, kablosuz Bluetooth bağlantısı.', 'price' => 3499.00, 'image' => 'https://images.unsplash.com/photo-1607677686474-ab93fc91d841?w=500&q=80'],
            26 => ['id' => 26, 'name' => 'Keychron K2 V2 Mekanik Klavye', 'description' => 'Kablosuz RGB Mekanik Klavye, Gateron G Pro Switch, Mac ve Windows uyumlu.', 'price' => 3899.00, 'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=500&q=80'],
            27 => ['id' => 27, 'name' => 'Logitech MX Keys S Kablosuz Klavye', 'description' => 'Akıllı aydınlatma, ergonomik tuş yapısı, çoklu cihaz eşleştirme desteği.', 'price' => 4599.00, 'image' => 'https://images.unsplash.com/photo-1587829740319-6208035277f7?w=500&q=80'],
            28 => ['id' => 28, 'name' => 'SteelSeries Apex Pro TKL Wireless', 'description' => 'Dünyanın en hızlı OmniPoint 2.0 ayarlanabilir anahtarları, OLED akıllı ekran.', 'price' => 8999.00, 'image' => 'https://images.unsplash.com/photo-1595225476474-87563907a212?w=500&q=80'],
            29 => ['id' => 29, 'name' => 'Asus ROG Azoth %75 Mekanik Klavye', 'description' => 'OLED ekran, conta montajlı yapı, yağlanmış ROG NX anahtarlar, hot-swap.', 'price' => 9499.00, 'image' => 'https://images.unsplash.com/photo-1511467687858-23d96c32e4ae?w=500&q=80'],
            30 => ['id' => 30, 'name' => 'Corsair K70 RGB PRO Mekanik Klavye', 'description' => 'CHERRY MX Red anahtarlar, 8.000Hz hyper-polling hızı, alüminyum kasa.', 'price' => 5299.00, 'image' => 'https://images.unsplash.com/photo-1618384887929-16ec33fab9ef?w=500&q=80']
        ];
    @endphp

    <!-- Üst Menü / Navbar -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ route('products.index') }}" class="text-2xl font-black text-indigo-600 tracking-tight flex items-center gap-2">
                <i class="fa-solid fa-store"></i> TeknoMağaza
            </a>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.dashboard') }}" class="bg-slate-900 text-white font-bold text-xs px-4 py-2.5 rounded-xl hover:bg-slate-800 transition flex items-center gap-2">
                    <i class="fa-solid fa-user-shield"></i> Admin Paneli
                </a>

                <a href="{{ route('cart.index') }}" class="bg-indigo-50 text-indigo-600 font-bold text-xs px-4 py-2.5 rounded-xl hover:bg-indigo-100 transition flex items-center gap-2">
                    <i class="fa-solid fa-cart-shopping"></i> Sepetim
                    <span class="bg-indigo-600 text-white text-[10px] w-5 h-5 rounded-full flex items-center justify-center font-bold ml-1">
                        {{ $cartCount }}
                    </span>
                </a>

                <a href="{{ route('favorites.index') }}" class="bg-rose-600 text-white font-bold text-xs px-4 py-2.5 rounded-xl transition flex items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-heart"></i> Favorilerim
                    <span class="bg-white text-rose-600 text-[10px] w-5 h-5 rounded-full flex items-center justify-center font-bold ml-1">
                        {{ $favCount }}
                    </span>
                </a>
            </div>
        </div>
    </header>

    <!-- İçerik -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-black text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-heart text-rose-500"></i> Favori Ürünleriniz
                </h1>
                <p class="text-xs text-slate-500 font-medium mt-1">Beğendiğiniz ve takibe aldığınız ürünler burada listelenir.</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                <i class="fa-solid fa-arrow-left"></i> Alışverişe Devam Et
            </a>
        </div>

        @if(count($favorites) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($favorites as $favId)
                    @if(isset($allProducts[$favId]))
                        @php
                            $product = $allProducts[$favId];
                            $inCartCount = isset($cart[$favId]) ? $cart[$favId]['quantity'] : 0;
                        @endphp

                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md transition flex flex-col justify-between relative">
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="bg-rose-100 text-rose-700 text-[10px] font-bold px-2 py-0.5 rounded-md">FAVORİ</span>
                                    
                                    <a href="{{ route('favorites.toggle', $product['id']) }}" class="w-8 h-8 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center transition hover:bg-rose-100" title="Favorilerden Çıkar">
                                        <i class="fa-solid fa-heart text-sm"></i>
                                    </a>
                                </div>

                                <div class="h-48 w-full bg-slate-50 rounded-xl overflow-hidden flex items-center justify-center p-2 mb-4">
                                    <img src="{{ $product['image'] }}" class="max-h-full max-w-full object-contain">
                                </div>

                                <h3 class="font-bold text-slate-900 text-sm mb-1 line-clamp-1">{{ $product['name'] }}</h3>
                                <p class="text-xs text-slate-500 mb-3 line-clamp-2 h-8">{{ $product['description'] }}</p>
                            </div>

                            <div class="p-4 pt-0">
                                <div class="text-lg font-black text-slate-900 mb-3">
                                    ₺{{ number_format($product['price'], 2, ',', '.') }}
                                </div>

                                <a href="{{ route('cart.add', $product['id']) }}" class="w-full flex items-center justify-center gap-2 text-white font-bold text-xs py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 transition">
                                    <i class="fa-solid fa-cart-shopping"></i> Sepete Ekle
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center max-w-lg mx-auto my-12">
                <div class="w-16 h-16 bg-rose-50 text-rose-500 rounded-full flex items-center justify-center text-2xl mx-auto mb-4">
                    <i class="fa-solid fa-heart-crack"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-1">Favori listeniz henüz boş</h3>
                <p class="text-xs text-slate-500 mb-6">Beğendiğiniz ürünlerin üzerindeki kalp simgesine tıklayarak favorilerinize ekleyebilirsiniz.</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white font-bold text-xs px-6 py-3 rounded-xl hover:bg-indigo-700 transition">
                    <i class="fa-solid fa-store"></i> Ürünleri İncele
                </a>
            </div>
        @endif
    </main>

</body>
</html>