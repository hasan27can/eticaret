<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ürün Düzenle') }}: {{ $product->name }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 font-semibold text-sm">
                ← Panele Geri Dön
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 p-6">
                
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded-xl">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Ürün Adı</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
                            <select name="category_id" id="category_id" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-semibold text-gray-700 mb-1">Fiyat (₺)</label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>

                        <div>
                            <label for="stock" class="block text-sm font-semibold text-gray-700 mb-1">Stok Adedi</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-semibold text-gray-700 mb-1">Görsel URL</label>
                        <input type="url" name="image" id="image" value="{{ old('image', $product->image) }}" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Açıklama</label>
                        <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t">
                        <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-semibold text-sm hover:bg-gray-50 transition">
                            İptal
                        </a>
                        <button type="submit" class="px-5 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm transition">
                            Güncellemeleri Kaydet
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>