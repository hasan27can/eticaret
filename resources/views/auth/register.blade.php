<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol - TeknoMağaza</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">
        <div class="text-center mb-6">
            <a href="{{ route('products.index') }}" class="text-3xl font-extrabold text-indigo-600">TeknoMağaza</a>
            <p class="text-xs text-gray-500 mt-1">Yeni bir hesap oluşturun</p>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 text-xs p-3 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Ad Soyad</label>
                <input type="text" name="name" required placeholder="Ahmet Yılmaz" class="w-full border rounded-lg p-2.5 text-sm focus:outline-indigo-600">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">E-Posta Adresi</label>
                <input type="email" name="email" required placeholder="ornek@mail.com" class="w-full border rounded-lg p-2.5 text-sm focus:outline-indigo-600">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Şifre</label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full border rounded-lg p-2.5 text-sm focus:outline-indigo-600">
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 rounded-lg text-sm transition">
                Kayıt Ol
            </button>
        </form>

        <p class="text-xs text-center text-gray-500 mt-6">
            Zaten hesabınız var mı? <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline">Giriş Yapın</a>
        </p>
    </div>

</body>
</html>