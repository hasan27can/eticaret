<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Yönetim Paneli') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- İstatistik Kartları -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                    <div class="text-sm font-medium text-gray-500">Toplam Sipariş</div>
                    <div class="text-2xl font-bold text-emerald-600 mt-2">{{ $totalOrders ?? 0 }}</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                    <div class="text-sm font-medium text-gray-500">Toplam Ürün Sayısı</div>
                    <div class="text-2xl font-bold text-amber-600 mt-2">{{ $totalProducts ?? 0 }}</div>
                </div>
            </div>

            <!-- Ürün Yönetimi -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6">
                    <!-- Ürün Listesi Başlığı ve Yeni Ürün Ekle Butonu -->
                    <div class="flex justify-between items-center mb-6 border-b pb-4">
                        <h3 class="text-lg font-bold text-gray-800">Ürün Listesi</h3>
                        <a href="{{ route('admin.products.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-lg text-sm transition">
                            + Yeni Ürün Ekle
                        </a>
                    </div>

                    <!-- Ürün Tablosu -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
                                    <th class="p-3">Görsel</th>
                                    <th class="p-3">Ürün Adı</th>
                                    <th class="p-3">Fiyat</th>
                                    <th class="p-3">Stok</th>
                                    <th class="p-3 text-right">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($products as $product)
                                    <tr>
                                        <td class="p-3">
                                            @if($product->image)
                                                <img src="{{ $product->image }}" class="w-10 h-10 object-cover rounded">
                                            @else
                                                <div class="w-10 h-10 bg-gray-200 rounded flex items-center justify-center text-xs text-gray-500">Yok</div>
                                            @endif
                                        </td>
                                        <td class="p-3 font-medium text-gray-800">{{ $product->name }}</td>
                                        <td class="p-3 text-gray-600">₺{{ number_format($product->price, 2) }}</td>
                                        <td class="p-3 text-gray-600">{{ $product->stock ?? 0 }}</td>
                                        <td class="p-3 text-right space-x-2">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-indigo-600 hover:underline text-xs">Düzenle</a>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Bu ürünü silmek istediğinize emin misiniz?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline text-xs">Sil</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-4 text-center text-gray-500 text-sm">Henüz eklenmiş bir ürün bulunmuyor.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>