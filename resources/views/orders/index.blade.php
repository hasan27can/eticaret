<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Siparişlerim') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 p-6">
                
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <h3 class="text-lg font-bold text-gray-800 mb-6">Geçmiş Siparişleriniz</h3>

                @forelse($orders as $order)
                    <div class="mb-6 border border-gray-200 rounded-xl p-5 bg-gray-50/50">
                        <!-- Sipariş Başlık Bilgileri -->
                        <div class="flex flex-wrap justify-between items-center pb-4 mb-4 border-b border-gray-200 gap-2">
                            <div>
                                <span class="text-xs text-gray-500 uppercase block">Sipariş No</span>
                                <span class="font-bold text-gray-800">#{{ $order->id }}</span>
                            </div>
                            <div>
                                <span class="text-xs text-gray-500 uppercase block">Tarih</span>
                                <span class="text-sm text-gray-700 font-medium">{{ $order->created_at->format('d.m.Y H:i') }}</span>
                            </div>
                            <div>
                                <span class="text-xs text-gray-500 uppercase block">Durum</span>
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-md bg-yellow-100 text-yellow-800">
                                    {{ ucfirst($order->status ?? 'Beklemede') }}
                                </span>
                            </div>
                            <div>
                                <span class="text-xs text-gray-500 uppercase block">Toplam Tutar</span>
                                <span class="font-bold text-indigo-600 text-lg">₺{{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>

                        <!-- Siparişteki Ürünler -->
                        <div class="space-y-3">
                            @foreach($order->items as $item)
                                <div class="flex justify-between items-center text-sm">
                                    <div class="flex items-center space-x-3">
                                        <span class="font-medium text-gray-800">{{ $item->product->name ?? 'Ürün Silinmiş' }}</span>
                                        <span class="text-gray-500 text-xs">({{ $item->quantity }} Adet)</span>
                                    </div>
                                    <span class="font-semibold text-gray-700">₺{{ number_format($item->price * $item->quantity, 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <p class="text-gray-500 mb-4">Henüz verilmiş bir siparişiniz bulunmuyor.</p>
                        <a href="{{ route('home') }}" class="text-indigo-600 font-semibold hover:underline">
                            ← Alışverişe Başla
                        </a>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>