<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilim - TeknoMağaza</title>
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
                <a href="{{ route('orders.myOrders') }}" class="text-gray-700 hover:text-indigo-600 font-semibold">Siparişlerim</a>
                <a href="{{ route('favorites.index') }}" class="text-gray-700 hover:text-red-500 font-semibold">❤️ Favorilerim</a>
                <a href="/" class="text-indigo-600 hover:underline font-semibold">← Mağazaya Dön</a>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-6 flex items-center gap-2">
            👤 Profil & Adres Bilgilerim
        </h1>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-800 rounded-xl">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 lg:p-8">
            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Ad Soyad</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">E-Posta Adresi</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Telefon Numarası</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="05XXXXXXXXX" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Şehir</label>
                        <input type="text" name="city" value="{{ old('city', $user->city) }}" placeholder="İstanbul" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Teslimat Adresi</label>
                    <textarea name="address" rows="3" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none" placeholder="Mahalle, Cadde, Sokak, Bina No, Daire No">{{ old('address', $user->address) }}</textarea>
                </div>

                <hr class="border-gray-200 my-6">

                <h3 class="text-lg font-bold text-gray-800 mb-2">🔒 Şifre Değiştir (İsteğe Bağlı)</h3>
                <p class="text-xs text-gray-500 mb-4">Şifrenizi değiştirmek istemiyorsanız bu alanları boş bırakabilirsiniz.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Yeni Şifre</label>
                        <input type="password" name="password" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Yeni Şifre Tekrarı</label>
                        <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-xl shadow transition duration-200">
                        Bilgileri Kaydet
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>