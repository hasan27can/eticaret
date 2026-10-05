<x-mail::message>
# Merhaba {{ $order->name }},

Siparişiniz başarıyla alındı ve işleme konuldu!

**Sipariş Numarası:** #{{ $order->id }}  
**Sipariş Tarihi:** {{ $order->created_at->format('d.m.Y H:i') }}  
**Ödeme Yöntemi:** 
@if($order->payment_method == 'bank_transfer') Havale / EFT 
@elseif($order->payment_method == 'cod') Kapıda Ödeme 
@else Kredi Kartı @endif

### Sipariş Özeti

@foreach($order->items as $item)
- **{{ $item['name'] }}** (x{{ $item['quantity'] }}) - ₺{{ number_format($item['price'] * $item['quantity'], 2) }}
@endforeach

**Toplam Tutar:** ₺{{ number_format($order->total_amount, 2) }}

### Teslimat Adresi
{{ $order->address }}

<x-mail::button :url="route('orders.myOrders')">
Siparişimi Takip Et
</x-mail::button>

Teşekkür ederiz,<br>
{{ config('app.name') }}
</x-mail::message>