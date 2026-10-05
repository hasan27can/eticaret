<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Siparişlerim') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-6">Geçmiş Sipariş Geçmişiniz</h3>

                @if($orders->count() > 0)
                    <div class="space-y-6">
                        @foreach($orders as $order)
                            <div class="border rounded-lg p-4 bg-gray-50 shadow-sm">
                                <div class="flex flex-wrap justify-between items-center border-b pb-3 mb-3 gap-2">
                                    <div>
                                        <span class="font-bold text-gray-700">Sipariş #{{ $order->id }}</span>
                                        <span class="text-xs text-gray-500 ml-2">({{ $order->created_at->format('d.m.Y H:i') }})</span>
                                    </div>
                                    <div class="space-x-2">
                                        <!-- Ödeme Yöntemi Rozeti -->
                                        <span class="bg-blue-100 text-blue-800 text-xs px-2.5 py-0.5 rounded font-semibold">
                                            @if($order->payment_method == 'bank_transfer') Havale / EFT
                                            @elseif($order->payment_method == 'cod') Kapıda Ödeme
                                            @else Kredi Kartı @endif
                                        </span>

                                        <!-- Durum Rozeti -->
                                        @if($order->status == 'pending')
                                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2.5 py-0.5 rounded font-bold">Beklemede</span>
                                        @elseif($order->status == 'completed')
                                            <span class="bg-green-100 text-green-800 text-xs px-2.5 py-0.5 rounded font-bold">Tamamlandı</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs px-2.5 py-0.5 rounded font-bold">İptal Edildi</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <h4 class="text-xs font-bold text-gray-500 uppercase mb-2">Satın Alınan Ürünler</h4>
                                        <ul class="text-sm space-y-1">
                                            @foreach($order->items as $item)
                                                <li class="flex justify-between border-b border-gray-200 py-1">
                                                    <span>{{ $item['name'] }} <strong class="text-indigo-600">x{{ $item['quantity'] }}</strong></span>
                                                    <span class="font-medium">₺{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="flex flex-col justify-between bg-white p-3 rounded border">
                                        <div>
                                            <h4 class="text-xs font-bold text-gray-500 uppercase mb-1">Teslimat Adresi</h4>
                                            <p class="text-xs text-gray-600 mb-2">{{ $order->address }}</p>
                                        </div>
                                        <div class="border-t pt-2 mt-2 flex justify-between items-center">
                                            <span class="font-bold text-gray-700">Toplam Tutar:</span>
                                            <span class="text-lg font-bold text-indigo-600">₺{{ number_format($order->total_amount, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <p class="text-lg mb-2">Henüz verdiğiniz bir sipariş bulunmuyor.</p>
                        <a href="{{ route('home') }}" class="text-indigo-600 font-semibold hover:underline">Alışverişe Başla →</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>