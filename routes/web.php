<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes - E-Ticaret Platformu
|--------------------------------------------------------------------------
*/

// Mock Data / Veritabanı Yardımcı Fonksiyonu
if (!function_exists('getProductsList')) {
    function getProductsList() {
        $defaultProducts = [
            // FARELER (1-5)
            1 => ['id' => 1, 'name' => 'Logitech G Pro X Superlight Kablosuz Fare', 'price' => 3899, 'stock' => 15, 'category' => 'fare', 'badge' => 'Çok Satan', 'description' => '63 gramdan hafif, HERO 25K sensörlü ultra hafif profesyonel oyuncu faresi.', 'image' => 'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?auto=format&fit=crop&w=800&q=80'],
            2 => ['id' => 2, 'name' => 'Razer DeathAdder V3 Pro Kablosuz Fare', 'price' => 4199, 'stock' => 10, 'category' => 'fare', 'badge' => 'Yeni', 'description' => 'Ergonomik tasarım, Focus Pro 30K optik sensör ve 90 saat pil ömrü.', 'image' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?auto=format&fit=crop&w=800&q=80'],
            3 => ['id' => 3, 'name' => 'SteelSeries Rival 3 Kablolu Oyuncu Faresi', 'price' => 899, 'stock' => 25, 'category' => 'fare', 'badge' => 'Fırsat', 'description' => 'TrueMove Core optik sensör, RGB Prism aydınlatma ve 60 milyon tık ömrü.', 'image' => 'https://images.unsplash.com/photo-1629429408209-1f912961dbd8?auto=format&fit=crop&w=800&q=80'],
            4 => ['id' => 4, 'name' => 'Logitech MX Master 3S Ergonomik Ofis Faresi', 'price' => 3499, 'stock' => 8, 'category' => 'fare', 'badge' => 'Popüler', 'description' => 'Sessiz tıklama, MagSpeed hızlı kaydırma tekerleği.', 'image' => 'https://images.unsplash.com/photo-1551107696-a4b0c5a0d9a2?auto=format&fit=crop&w=800&q=80'],
            5 => ['id' => 5, 'name' => 'Asus ROG Gladius III Wireless AimPoint Fare', 'price' => 3299, 'stock' => 12, 'category' => 'fare', 'badge' => 'İndirim', 'description' => '36.000 DPI AimPoint optik sensör, değiştirilebilir anahtar soketleri.', 'image' => 'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?auto=format&fit=crop&w=800&q=80'],

            // KLAVYELER (6-10)
            6 => ['id' => 6, 'name' => 'Corsair K70 RGB PRO Mekanik Klavye', 'price' => 4599, 'stock' => 7, 'category' => 'klavye', 'badge' => 'Öne Çıkan', 'description' => 'Cherry MX Red anahtarlar, alüminyum kasa.', 'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?auto=format&fit=crop&w=800&q=80'],
            7 => ['id' => 7, 'name' => 'SteelSeries Apex Pro TKL (2023) Mekanik Klavye', 'price' => 6299, 'stock' => 5, 'category' => 'klavye', 'badge' => 'E-Spor', 'description' => 'OmniPoint 2.0 ayarlanabilir hiper hızlı anahtarlar ve OLED akıllı ekran.', 'image' => 'https://images.unsplash.com/photo-1595225476474-87563907a212?auto=format&fit=crop&w=800&q=80'],
            8 => ['id' => 8, 'name' => 'Logitech G915 LIGHTSPEED Kablosuz RGB Klavye', 'price' => 5899, 'stock' => 9, 'category' => 'klavye', 'badge' => 'Kablosuz', 'description' => 'Düşük profilli GL Tactile mekanik anahtarlar.', 'image' => 'https://images.unsplash.com/photo-1511467687858-23d96c32e4ae?auto=format&fit=crop&w=800&q=80'],
            9 => ['id' => 9, 'name' => 'Razer BlackWidow V4 75% Hot-Swappable Klavye', 'price' => 5199, 'stock' => 4, 'category' => 'klavye', 'badge' => 'Yeni', 'description' => 'Değiştirilebilir anahtar yapısı, Razer Orange dokunsal switchler.', 'image' => 'https://images.unsplash.com/photo-1618384887929-16ec33fab9ef?auto=format&fit=crop&w=800&q=80'],
            10 => ['id' => 10, 'name' => 'Keychron K2 V2 Kablosuz Mekanik Klavye', 'price' => 3299, 'stock' => 18, 'category' => 'klavye', 'badge' => 'Mac/Win', 'description' => 'Mac ve Windows uyumlu, Gateron Brown switch.', 'image' => 'https://images.unsplash.com/photo-1561633096-7a0305a415ff?auto=format&fit=crop&w=800&q=80'],

            // KABLOLU KULAKLIKLAR (11-15)
            11 => ['id' => 11, 'name' => 'HyperX Cloud II 7.1 Oyuncu Kulaklığı', 'price' => 2299, 'stock' => 20, 'category' => 'kablolu-kulaklik', 'badge' => 'Efsane', 'description' => 'Hafızalı köpük kulak yastıkları, donanım tabanlı 7.1 ses.', 'image' => 'https://images.unsplash.com/photo-1546435770-a3e426bf472b?auto=format&fit=crop&w=800&q=80'],
            12 => ['id' => 12, 'name' => 'Razer BlackShark V2 X Kablolu Kulaklık', 'price' => 1499, 'stock' => 15, 'category' => 'kablolu-kulaklik', 'badge' => 'F/P', 'description' => 'TriForce 50mm sürücüler, HyperClear kardioid mikrofon.', 'image' => 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?auto=format&fit=crop&w=800&q=80'],
            13 => ['id' => 13, 'name' => 'Audio-Technica ATH-M50x Stüdyo Kulaklığı', 'price' => 4899, 'stock' => 6, 'category' => 'kablolu-kulaklik', 'badge' => 'Stüdyo', 'description' => 'Profesyonel stüdyo monitör kulaklığı.', 'image' => 'https://images.unsplash.com/photo-1583394838336-acd977736f90?auto=format&fit=crop&w=800&q=80'],
            14 => ['id' => 14, 'name' => 'Sennheiser HD 560S Açık Arkalı Kulaklık', 'price' => 5999, 'stock' => 3, 'category' => 'kablolu-kulaklik', 'badge' => 'Odyofil', 'description' => 'Odyofil seviyesi doğal ses deneyimi.', 'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80'],
            15 => ['id' => 15, 'name' => 'JBL Quantum 100 Oyuncu Kulaklığı', 'price' => 999, 'stock' => 30, 'category' => 'kablolu-kulaklik', 'badge' => 'Uygun Fiyat', 'description' => 'JBL QuantumSOUND Immersive ses teknolojisi.', 'image' => 'https://images.unsplash.com/photo-1572536147248-ac59a8abfa4b?auto=format&fit=crop&w=800&q=80'],

            // KABLOSUZ KULAKLIKLAR (16-20)
            16 => ['id' => 16, 'name' => 'Sony WH-1000XM5 Bluetooth Kulaklık', 'price' => 11499, 'stock' => 8, 'category' => 'kablosuz-kulaklik', 'badge' => 'ANC Lideri', 'description' => 'Sektör lideri aktif gürültü engelleme (ANC).', 'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80'],
            17 => ['id' => 17, 'name' => 'Apple AirPods Pro (2. Nesil USB-C)', 'price' => 8499, 'stock' => 14, 'category' => 'kablosuz-kulaklik', 'badge' => 'Apple', 'description' => 'H2 çip, 2 kata kadar daha fazla Aktif Gürültü Engelleme.', 'image' => 'https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?auto=format&fit=crop&w=800&q=80'],
            18 => ['id' => 18, 'name' => 'Sennheiser Momentum 4 Wireless Kulaklık', 'price' => 10299, 'stock' => 5, 'category' => 'kablosuz-kulaklik', 'badge' => '60 Saat Pil', 'description' => '60 saate varan muazzam pil ömrü.', 'image' => 'https://images.unsplash.com/photo-1545127398-14699f92334b?auto=format&fit=crop&w=800&q=80'],
            19 => ['id' => 19, 'name' => 'Anker Soundcore Life Q30 Bluetooth Kulaklık', 'price' => 2399, 'stock' => 22, 'category' => 'kablosuz-kulaklik', 'badge' => 'F/P Şampiyonu', 'description' => 'Çoklu modlu ANC, 40 saatlik şarj süresi.', 'image' => 'https://images.unsplash.com/photo-1577174881658-0f30ed549adc?auto=format&fit=crop&w=800&q=80'],
            20 => ['id' => 20, 'name' => 'JBL Tune 520BT Kablosuz Kulak Üstü Kulaklık', 'price' => 1599, 'stock' => 25, 'category' => 'kablosuz-kulaklik', 'badge' => 'Pure Bass', 'description' => 'JBL Pure Bass sesi, 57 saat dinleme.', 'image' => 'https://images.unsplash.com/photo-1590658006821-04f4008d5717?auto=format&fit=crop&w=800&q=80'],

            // DİZÜSTÜ BİLGİSAYARLAR (21-25)
            21 => ['id' => 21, 'name' => 'Apple MacBook Air M2 (16GB RAM / 512GB SSD)', 'price' => 42999, 'stock' => 6, 'category' => 'dizustu-bilgisayar', 'badge' => 'M2 Çip', 'description' => 'Liquid Retina ekran ve 18 saate varan pil ömrü.', 'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=800&q=80'],
            22 => ['id' => 22, 'name' => 'ASUS ROG Strix G16 (i7-13650HX / RTX 4060)', 'price' => 51999, 'stock' => 4, 'category' => 'dizustu-bilgisayar', 'badge' => 'Oyuncu', 'description' => '16 inç 165Hz ROG Nebula ekran.', 'image' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?auto=format&fit=crop&w=800&q=80'],
            23 => ['id' => 23, 'name' => 'Lenovo Legion Pro 5 (Ryzen 7 7745HX / RTX 4070)', 'price' => 59999, 'stock' => 3, 'category' => 'dizustu-bilgisayar', 'badge' => 'RTX 4070', 'description' => '240Hz WQXGA ekran, AI Coldfront 5.0 soğutma.', 'image' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?auto=format&fit=crop&w=800&q=80'],
            24 => ['id' => 24, 'name' => 'Dell XPS 13 Ultra Thin (i7-1360P / 16GB RAM)', 'price' => 48999, 'stock' => 5, 'category' => 'dizustu-bilgisayar', 'badge' => 'Premium İş', 'description' => 'İş dünyası için tasarlanmış CNC işlenmiş alüminyum gövde.', 'image' => 'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?auto=format&fit=crop&w=800&q=80'],
            25 => ['id' => 25, 'name' => 'HP Victus 16 (i5-13500H / RTX 4050)', 'price' => 29999, 'stock' => 10, 'category' => 'dizustu-bilgisayar', 'badge' => 'F/P Laptop', 'description' => 'Fiyat/performans oyuncu dizüstü bilgisayarı.', 'image' => 'https://images.unsplash.com/photo-1525547719571-a2d4ac8945e2?auto=format&fit=crop&w=800&q=80'],

            // AKILLI SAATLER (26-30)
            26 => ['id' => 26, 'name' => 'Apple Watch Series 9 GPS 45mm', 'price' => 16499, 'stock' => 12, 'category' => 'akilli-saat', 'badge' => 'Series 9', 'description' => 'S9 SiP çip, Çift Dokunma hareketi.', 'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=800&q=80'],
            27 => ['id' => 27, 'name' => 'Samsung Galaxy Watch 6 Classic 47mm', 'price' => 9499, 'stock' => 9, 'category' => 'akilli-saat', 'badge' => 'Dönen Çerçeve', 'description' => 'Dönen fiziksel çerçeve, EKG ve Uyku Koçluğu.', 'image' => 'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?auto=format&fit=crop&w=800&q=80'],
            28 => ['id' => 28, 'name' => 'Huawei Watch GT 4 46mm Akıllı Saat', 'price' => 5999, 'stock' => 15, 'category' => 'akilli-saat', 'badge' => '14 Gün Pil', 'description' => '14 güne varan pil ömrü, geometrik estetik tasarım.', 'image' => 'https://images.unsplash.com/photo-1579586337278-3befd40fd17a?auto=format&fit=crop&w=800&q=80'],
            29 => ['id' => 29, 'name' => 'Garmin Fenix 7X Solar Safir Akıllı Saat', 'price' => 28999, 'stock' => 3, 'category' => 'akilli-saat', 'badge' => 'Solar Şarj', 'description' => 'Güneş enerjisiyle şarj olan safir cam, dahili LED fener.', 'image' => 'https://images.unsplash.com/photo-1544117519-31a4b719223d?auto=format&fit=crop&w=800&q=80'],
            30 => ['id' => 30, 'name' => 'Xiaomi Watch S1 Active Akıllı Saat', 'price' => 3299, 'stock' => 20, 'category' => 'akilli-saat', 'badge' => 'Spor', 'description' => '1.43 inç AMOLED ekran, 117 farklı fitness modu.', 'image' => 'https://images.unsplash.com/photo-1510017803434-a899398421b3?auto=format&fit=crop&w=800&q=80']
        ];

        $customProducts = session()->get('custom_products', []);
        return array_replace($defaultProducts, $customProducts);
    }
}

/*
|--------------------------------------------------------------------------
| 1. AUTH & KULLANICI PROFİL ROTALARI
|--------------------------------------------------------------------------
*/

Route::get('/login', fn() => view('auth.login'))->name('login');

Route::post('/login', function (Request $request) {
    session()->put('user', [
        'id' => 1,
        'name' => 'Ahmet Yılmaz',
        'email' => $request->input('email', 'ahmet@example.com'),
        'phone' => '0555 555 55 55',
        'address' => 'Atatürk Mah. No:123, İstanbul',
        'role' => 'admin'
    ]);
    return redirect()->route('products.index')->with('success', 'Giriş yapıldı!');
})->name('login.post');

Route::get('/register', fn() => view('auth.register'))->name('register');

Route::post('/register', function (Request $request) {
    session()->put('user', [
        'id' => rand(10, 100),
        'name' => $request->input('name', 'Yeni Kullanıcı'),
        'email' => $request->input('email', 'yeni@example.com'),
        'phone' => '',
        'address' => '',
        'role' => 'user'
    ]);
    return redirect()->route('products.index')->with('success', 'Kayıt başarılı!');
})->name('register.post');

Route::any('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login')->with('success', 'Oturum kapatıldı.');
})->name('logout');

Route::get('/sifremi-unuttum', fn() => view('auth.forgot-password'))->name('password.request');

Route::post('/sifremi-unuttum', function () {
    return redirect()->route('login')->with('success', 'Şifre sıfırlama bağlantısı e-posta adresinize gönderildi!');
})->name('password.email');

Route::get('/profil', function () {
    if (!session()->has('user')) return redirect()->route('login');
    return view('user.profile', ['user' => session('user')]);
})->name('user.profile');

Route::post('/profil/guncelle', function (Request $request) {
    $user = session('user', []);
    $user['name'] = $request->input('name', $user['name'] ?? '');
    $user['phone'] = $request->input('phone', $user['phone'] ?? '');
    $user['address'] = $request->input('address', $user['address'] ?? '');
    
    session()->put('user', $user);
    return redirect()->back()->with('success', 'Profil bilgileriniz güncellendi!');
})->name('user.profile.update');

/*
|--------------------------------------------------------------------------
| 2. ANA SAYFA VE ÜRÜN DETAY ROTALARI
|--------------------------------------------------------------------------
*/

Route::get('/', function (Request $request) {
    $products = getProductsList();
    $selectedCategory = $request->get('category', 'all');
    $searchQuery = $request->get('search');
    $sort = $request->get('sort');

    $categories = [
        'fare' => 'Fare',
        'klavye' => 'Klavye',
        'kablolu-kulaklik' => 'Kablolu Kulaklık',
        'kablosuz-kulaklik' => 'Kablosuz Kulaklık',
        'akilli-saat' => 'Akıllı Saat',
        'dizustu-bilgisayar' => 'Dizüstü Bilgisayar'
    ];

    if ($selectedCategory !== 'all') {
        $products = array_filter($products, fn($p) => $p['category'] === $selectedCategory);
    }

    if ($searchQuery) {
        $products = array_filter($products, fn($p) => 
            str_contains(strtolower($p['name']), strtolower($searchQuery)) || 
            str_contains(strtolower($p['description']), strtolower($searchQuery))
        );
    }

    if ($sort === 'price_asc') {
        usort($products, fn($a, $b) => $a['price'] <=> $b['price']);
    } elseif ($sort === 'price_desc') {
        usort($products, fn($a, $b) => $b['price'] <=> $a['price']);
    }

    $products = array_map(fn($item) => (object) $item, array_values($products));

    return view('products.index', compact('products', 'categories', 'selectedCategory', 'searchQuery', 'sort'));
})->name('products.index');

Route::get('/products/create', function () {
    $rawCategories = [
        'fare' => 'Fare',
        'klavye' => 'Klavye',
        'kablolu-kulaklik' => 'Kablolu Kulaklık',
        'kablosuz-kulaklik' => 'Kablosuz Kulaklık',
        'akilli-saat' => 'Akıllı Saat',
        'dizustu-bilgisayar' => 'Dizüstü Bilgisayar'
    ];

    $categories = [];
    foreach ($rawCategories as $id => $name) {
        $categories[] = (object)['id' => $id, 'name' => $name];
    }

    return view('admin.products.create', compact('categories'));
})->name('products.create');

Route::get('/product/{id}', function ($id) {
    $products = getProductsList();
    $id = (int)$id;

    if (!isset($products[$id])) {
        return redirect()->route('products.index')->with('error', 'Ürün bulunamadı!');
    }

    $product = $products[$id]; 
    
    $allReviews = session()->get('reviews', []);
    $productReviews = $allReviews[$id] ?? [];

    $avgRating = count($productReviews) > 0 
        ? round(array_sum(array_column($productReviews, 'rating')) / count($productReviews), 1) 
        : 0;

    return view('products.show', compact('product', 'productReviews', 'avgRating'));
})->name('products.show');

Route::get('/products/{id}', fn($id) => redirect()->route('products.show', ['id' => $id]));

Route::post('/product/{id}/review', function (Request $request, $id) {
    $id = (int)$id;
    $comment = $request->input('comment');

    if (!$comment) return redirect()->back()->with('error', 'Lütfen bir yorum yazın.');

    $reviews = session()->get('reviews', []);
    $reviews[$id][] = [
        'user' => session('user.name', 'Misafir Kullanıcı'),
        'rating' => (int) $request->input('rating', 5),
        'comment' => $comment,
        'date' => date('Y-m-d H:i')
    ];

    session()->put('reviews', $reviews);
    return redirect()->back()->with('success', 'Yorumunuz eklendi!');
})->name('products.review');

/*
|--------------------------------------------------------------------------
| 3. SEPET VE KUPON İŞLEMLERİ
|--------------------------------------------------------------------------
*/

Route::get('/sepetim', function () {
    $cart = session()->get('cart', []);
    $subTotal = array_reduce($cart, fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
    $discount = session()->get('coupon.discount', 0);
    $totalPrice = max(0, $subTotal - $discount);

    return view('cart.index', compact('cart', 'subTotal', 'discount', 'totalPrice'));
})->name('cart.index');

Route::match(['get', 'post'], '/sepet/ekle/{id}', function (Request $request, $id) {
    $products = getProductsList();
    $id = (int)$id;

    if (!isset($products[$id])) return redirect()->back()->with('error', 'Ürün bulunamadı!');

    $product = $products[$id];
    $cart = session()->get('cart', []);
    $quantity = (int) $request->input('quantity', 1);

    if (isset($cart[$id])) {
        $cart[$id]['quantity'] += $quantity;
    } else {
        $cart[$id] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'image' => $product['image'],
            'quantity' => $quantity
        ];
    }

    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Ürün sepete eklendi!');
})->name('cart.add');

Route::delete('/sepet/cikar/{id}', function ($id) {
    $cart = session()->get('cart', []);
    unset($cart[$id]);
    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Ürün sepetten çıkarıldı!');
})->name('cart.remove');

Route::post('/sepet/temizle', function () {
    session()->forget(['cart', 'coupon']);
    return redirect()->back()->with('success', 'Sepetiniz temizlendi!');
})->name('cart.clear');

Route::post('/kupon-uygula', function (Request $request) {
    $code = strtoupper($request->input('code', ''));
    
    if ($code === 'INDIRIM100') {
        session()->put('coupon', ['code' => $code, 'discount' => 100]);
        return redirect()->back()->with('success', '100 TL indirim kuponu uygulandı!');
    }
    
    return redirect()->back()->with('error', 'Geçersiz kupon kodu!');
})->name('coupon.apply');

Route::match(['get', 'post'], '/sepet/azalt/{id}', function ($id) {
    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
        if ($cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        } else {
            unset($cart[$id]);
        }
        session()->put('cart', $cart);
    }
    return redirect()->back()->with('success', 'Ürün adeti güncellendi!');
})->name('cart.decrement');

Route::match(['get', 'post'], '/sepet/arttir/{id}', function ($id) {
    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
        session()->put('cart', $cart);
    }
    return redirect()->back()->with('success', 'Ürün adeti artırıldı!');
})->name('cart.increment');

/*
|--------------------------------------------------------------------------
| 4. ÖDEME (CHECKOUT) VE SİPARİŞ GEÇMİŞİ
|--------------------------------------------------------------------------
*/

Route::get('/checkout', function () {
    $cart = session()->get('cart', []);
    if (empty($cart)) return redirect()->route('cart.index')->with('error', 'Sepetiniz boş!');

    $subTotal = array_reduce($cart, fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
    $discount = session()->get('coupon.discount', 0);
    $totalPrice = max(0, $subTotal - $discount);

    return view('checkout.index', compact('cart', 'totalPrice'));
})->name('checkout.index');

Route::post('/checkout/tamamla', function (Request $request) {
    $cart = session()->get('cart', []);
    if (empty($cart)) return redirect()->route('products.index');

    $orderId = 'SIP-' . rand(100000, 999999);
    $orders = session()->get('orders', []);

    $orders[$orderId] = [
        'order_id' => $orderId,
        'items' => $cart,
        'total' => $request->input('total_price'),
        'address' => $request->input('address', 'Adres Belirtilmedi'),
        'payment_method' => $request->input('payment_method', 'Kredi Kartı'),
        'status' => 'Hazırlanıyor',
        'date' => date('Y-m-d H:i')
    ];

    session()->put('orders', $orders);
    session()->forget(['cart', 'coupon']);

    return redirect()->route('order.success', $orderId);
})->name('checkout.process');

Route::get('/siparis-basarili/{id}', function ($id) {
    $orders = session()->get('orders', []);
    if (!isset($orders[$id])) return redirect()->route('products.index');

    $order = $orders[$id];
    return view('checkout.success', compact('order'));
})->name('order.success');

Route::get('/siparislerim', function () {
    $orders = session()->get('orders', []);
    return view('user.orders', compact('orders'));
})->name('user.orders');

/*
|--------------------------------------------------------------------------
| 5. FAVORİLER ROTALARI
|--------------------------------------------------------------------------
*/

Route::get('/favorilerim', function () {
    $favorites = session()->get('favorites', []);
    $favoriteProducts = array_filter(getProductsList(), fn($p) => in_array($p['id'], $favorites));
    $favoriteProducts = array_map(fn($item) => (object) $item, array_values($favoriteProducts));

    return view('favorites.index', compact('favoriteProducts'));
})->name('favorites.index');

Route::match(['get', 'post'], '/favori/toggle/{id}', function ($id) {
    $id = (int)$id;
    $favorites = session()->get('favorites', []);

    if (in_array($id, $favorites)) {
        $favorites = array_diff($favorites, [$id]);
        $msg = 'Ürün favorilerden çıkarıldı!';
    } else {
        $favorites[] = $id;
        $msg = 'Ürün favorilere eklendi!';
    }

    session()->put('favorites', array_values($favorites));
    return redirect()->back()->with('success', $msg);
})->name('favorites.toggle');

/*
|--------------------------------------------------------------------------
| 6. ADMIN PANELİ ROTALARI
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    
    Route::match(['get', 'post'], '/dashboard', function (Request $request) {
        if ($request->isMethod('post') && ($request->has('name') || $request->has('product_name'))) {
            $customProducts = session()->get('custom_products', []);
            $newId = count(getProductsList()) + rand(100, 999);

            $customProducts[$newId] = [
                'id'          => $newId,
                'name'        => $request->input('name') ?? $request->input('product_name', 'Yeni Ürün'),
                'price'       => (float) $request->input('price', 0),
                'badge'       => $request->input('badge', 'Yeni'),
                'image'       => $request->input('image', 'https://via.placeholder.com/150'),
                'description' => $request->input('description', ''),
                'stock'       => (int) $request->input('stock', 10),
                'category'    => $request->input('category', 'fare')
            ];

            session()->put('custom_products', $customProducts);
            return redirect()->route('admin.dashboard')->with('success', 'Ürün başarıyla eklendi!');
        }

        $totalProducts  = count(getProductsList());
        $totalOrders    = count(session()->get('orders', []));
        $totalReviews   = count(session()->get('reviews', []));
        $customProducts = session()->get('custom_products', []);
        
        return view('admin_dashboard', compact('totalProducts', 'totalOrders', 'totalReviews', 'customProducts'));
    })->name('dashboard');

    Route::get('/orders', function () {
        $orders = session()->get('orders', []);
        return view('admin_orders', compact('orders'));
    })->name('orders.index');

    Route::post('/orders/{id}/status', function (Request $request, $id) {
        $orders = session()->get('orders', []);
        if (isset($orders[$id])) {
            $orders[$id]['status'] = $request->input('status');
            session()->put('orders', $orders);
        }
        return redirect()->back()->with('success', 'Sipariş durumu güncellendi!');
    })->name('orders.update_status');

    Route::get('/products', function () {
        $products = array_values(getProductsList());
        return view('admin.products.index', compact('products'));
    })->name('products.index');

    Route::post('/products/store', function (Request $request) {
        $customProducts = session()->get('custom_products', []);
        $newId = count(getProductsList()) + rand(100, 999);

        $customProducts[$newId] = [
            'id'          => $newId,
            'name'        => $request->input('name') ?? $request->input('product_name', 'Yeni Ürün'),
            'price'       => (float) $request->input('price', 0),
            'badge'       => $request->input('badge', 'Yeni'),
            'image'       => $request->input('image', 'https://via.placeholder.com/150'),
            'description' => $request->input('description', ''),
            'stock'       => (int) $request->input('stock', 10),
            'category'    => $request->input('category', 'fare')
        ];

        session()->put('custom_products', $customProducts);
        return redirect()->route('admin.dashboard')->with('success', 'Yeni ürün başarıyla eklendi!');
    })->name('products.store');

    // ÜRÜN SİLME ROTASI (GET, POST ve DELETE İSTEKLERİNİN HEPSİNİ DESTEKLER)
    Route::match(['get', 'post', 'delete'], '/products/delete/{id}', function ($id) {
        $customProducts = session()->get('custom_products', []);

        foreach ($customProducts as $key => $product) {
            if ((string)$key === (string)$id || (string)($product['id'] ?? '') === (string)$id) {
                unset($customProducts[$key]);
            }
        }

        session()->put('custom_products', $customProducts);
        return redirect()->back()->with('success', 'Ürün başarıyla silindi.');
    })->name('products.delete');

    // BAZI BLADE SAYFALARINDAKİ {id} PARAMETRELİ DİĞER KULLANIM İÇİN ALTERNATİF ROTA EŞLEŞTİRMESİ
    Route::match(['get', 'post', 'delete'], '/products/{id}', function ($id) {
        $customProducts = session()->get('custom_products', []);

        foreach ($customProducts as $key => $product) {
            if ((string)$key === (string)$id || (string)($product['id'] ?? '') === (string)$id) {
                unset($customProducts[$key]);
            }
        }

        session()->put('custom_products', $customProducts);
        return redirect()->back()->with('success', 'Ürün başarıyla silindi.');
    });

    Route::get('/reviews', function () {
        $reviews = session()->get('reviews', []);
        return view('admin.reviews.index', compact('reviews'));
    })->name('reviews.index');
});

/*
|--------------------------------------------------------------------------
| 7. ALIAS VE TEMİZLEME ROTALARI
|--------------------------------------------------------------------------
*/

Route::get('/admin', fn() => redirect()->route('admin.dashboard'));
Route::get('/dashboard', fn() => redirect()->route('admin.dashboard'))->name('dashboard');
Route::get('/cart', fn() => redirect()->route('cart.index'));
Route::get('/sepet', fn() => redirect()->route('cart.index'));
Route::get('/favorites', fn() => redirect()->route('favorites.index'));

// SİLME İŞLEMİ ÇALIŞMAZSA TIKLAYIP SIFIRLAMAK İÇİN TEMİZLEME ADRESİ
Route::get('/admin/custom-products/clear', function () {
    session()->forget('custom_products');
    return redirect()->route('admin.dashboard')->with('success', 'Eklediğiniz tüm özel ürünler sıfırlandı!');
})->name('custom_products.clear');