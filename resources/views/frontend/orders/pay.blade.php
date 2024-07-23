@extends('frontend.layouts.apps')

@section('content')
<style>
    .payment-container {
        background-color: #f8e9d9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 0 auto;
        margin-top: 80px;
    }
    .payment-title {
        font-size: 24px;
        margin-bottom: 20px;
        font-weight: bold;
    }
</style>

<div class="container mt-5 mb-5">
    <div class="payment-container">
        <h2 class="payment-title">Pembayaran Pesanan #{{ $order->id }}</h2>
        <p><strong>Nama Penerima:</strong> {{ $order->name }}</p>
        <p><strong>Nomor Telepon:</strong> {{ $order->phone }}</p>
        <p><strong>Alamat:</strong> {{ $order->address }}</p>
        <p><strong>Total Pembayaran:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</p>

        <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function (event) {
        event.preventDefault();
        console.log('Snap Token:', '{{ $snapToken }}'); // Debugging
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert("Pembayaran berhasil!");
                window.location.href = "{{ route('order.success') }}";
            },
            onPending: function(result) {
                alert("Pembayaran tertunda!");
                console.log(result);
            },
            onError: function(result) {
                alert("Pembayaran gagal!");
                console.log(result);
            }
        });
    };
</script>
@endsection
