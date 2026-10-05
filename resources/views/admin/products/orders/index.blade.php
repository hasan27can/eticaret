<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sipariş Yönetimi (Admin)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <h3 class="text-lg font-bold mb-4">Gelen Siparişler</h3>

                @if(empty($orders))
                    <p class="text-gray-500">Henüz verilmiş bir sipariş bulunmuyor.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100 border-b border-gray-200">
                                    <th class="p-3">Sipariş NO</th>
                                    <th class="p-3">Tarih</th>
                                    <th class="p-3">Teslimat Adresi</th>
                                    <th class="p-3">Toplam Tutar</th>
                                    <th class="p-3">Durum</th>
                                    <th class="p-3">İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                                        <td class="p-3 font-semibold">{{ $order['order_id'] }}</td>
                                        <td class="p-3 text-sm text-gray-600">{{ $order['date'] }}</td>
                                        <td class="p-3 text-sm">{{ $order['address'] }}</td>
                                        <td class="p-3 font-bold text-indigo-600">{{ number_format($order['total'], 2) }} TL</td>
                                        <td class="p-3">
                                            <span class="px-3 py-1 text-xs rounded-full 
                                                @if($order['status'] == 'Tamamlandı') bg-green-100 text-green-800
                                                @elseif($order['status'] == 'Kargoda') bg-blue-100 text-blue-800
                                                @else bg-yellow-100 text-yellow-800 @endif">
                                                {{ $order['status'] }}
                                            </span>
                                        </td>
                                        <td class="p-3">
                                            <form action="{{ route('admin.orders.update_status', $order['order_id']) }}" method="POST" class="flex gap-2">
                                                @csrf
                                                <select name="status" class="text-xs rounded border-gray-300">
                                                    <option value="Hazırlanıyor" {{ $order['status'] == 'Hazırlanıyor' ? 'selected' : '' }}>Hazırlanıyor</option>
                                                    <option value="Kargoda" {{ $order['status'] == 'Kargoda' ? 'selected' : '' }}>Kargoda</option>
                                                    <option value="Tamamlandı" {{ $order['status'] == 'Tamamlandı' ? 'selected' : '' }}>Tamamlandı</option>
                                                </select>
                                                <button type="submit" class="bg-indigo-600 text-white text-xs px-3 py-1 rounded hover:bg-indigo-700">Güncelle</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>