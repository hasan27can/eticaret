<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Yeni Ürün Ekle') }}
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-900 font-semibold text-sm">
                &larr; Panele Geri Dön
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Ürün Adı</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="category" class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
                            <select name="category" id="category" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Kategori Seçin</option>
                                @foreach($categories as $category)
                                    <option value="{{ is_object($category) ? $category->id : $category }}">
                                        {{ is_object($category) ? $category->name : $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-semibold text-gray-700 mb-1">Fiyat (TL)</label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="stock" class="block text-sm font-semibold text-gray-700 mb-1">Stok Adedi</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', 10) }}" required 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-semibold text-gray-700 mb-1">Görsel URL</label>
                        <input type="url" name="image" id="image" value="{{ old('image') }}" placeholder="https://images.unsplash.com/..." 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Açıklama</label>
                        <textarea name="description" id="description" rows="4" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 border rounded-md text-gray-600 hover:bg-gray-50">İptal</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700">Ürünü Kaydet</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>