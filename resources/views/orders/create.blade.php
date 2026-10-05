<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Siparişi Tamamla') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 p-6">
                
                <h3 class="text-lg font-bold text-gray-800 mb-4">Sipariş Özeti & Teslimat Bilgileri</h3>

                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <!-- Adres ve Telefon Bilgileri -->
                    <div class="space-y-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Teslimat Adresi</label>
                            <textarea name="address" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" placeholder="Açık adresinizi yazın..." required>Atatürk Mah. Cumhuriyet Cad. No: 123/A</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Telefon Numarası</label>
                            <input type="text" name="phone" value="05555555555" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
                        </div>
                    </div>

                    <!-- Ürün Listesi Özet ve Toplam Tutar Hesabı -->
                    @php $grandTotal = 0; @endphp

                    <div class="border-t pt-4 mb-6">
                        <h4 class="font-semibold text-sm text-gray-700 mb-3">Sepetteki Ürünler</h4>
                        <div class="divide-y divide-gray-100">
                            @foreach($cartItems as $item)
                                @php 
                                    $itemTotal = ($item->product->price ?? 0) * $item->quantity;
                                    $grandTotal += $itemTotal;
                                @endphp
                                <div class="py-2 flex justify-between items-center text-sm">
                                    <div>
                                        <span class="font-medium text-gray-800">{{ $item->product->name ?? 'Ürün' }}</span>
                                        <span class="text-gray-500 text-xs ml-2">({{ $item->quantity }} Adet)</span>
                                    </div>
                                    <span class="font-semibold text-gray-700">₺{{ number_format($itemTotal, 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Toplam Tutar ve Buton -->
                    <div class="border-t pt-4 flex items-center justify-between">
                        <div>
                            <span class="text-sm text-gray-500 block">Toplam Ödenecek Tutar</span>
                            <span class="text-2xl font-bold text-indigo-600">
                                ₺{{ number_format($grandTotal, 2) }}
                            </span>
                        </div>

                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl transition shadow-md">
                            Siparişi Onayla ve Bitir →
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>