@extends('frontend.layouts.apps')

@section('content')
<style>
    .order-history-container {
        padding-top: 100px;
    }
    .order-card {
        background-color: #f8e9d9; /* Warna latar belakang yang sesuai */
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .order-card .card-header, .order-card .card-body {
        padding: 15px;
    }
    .order-card .card-header {
        background-color: #e2d5c3;
        border-bottom: 1px solid #d3c4b1;
        font-weight: bold;
    }
    .order-card .card-body {
        background-color: #f8e9d9;
    }
    .order-card h5 {
        margin-top: 10px;
        font-size: 18px;
    }
    .order-card .list-group-item {
        background-color: #f8e9d9;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
</style>

<div class="container order-history-container">
    <h2 class="mb-4">Riwayat Pesanan</h2>
    @if($orders->isEmpty())
        <p>Anda belum memiliki riwayat pesanan.</p>
    @else
        @foreach($orders as $order)
            <div class="card order-card">
                <div class="card-header">
                    <strong>Order ID:</strong> {{ $order->id }}
                    <span class="float-right"><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y') }}</span>
                </div>
                <div class="card-body">
                    <p><strong>Nama:</strong> {{ $order->name }}</p>
                    <p><strong>Alamat:</strong> {{ $order->address }}</p>
                    <p><strong>Status Pembayaran:</strong> {{ $order->payment_status }}</p>
                    <p><strong>Total:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                    <h5>Items:</h5>
                    <ul class="list-group">
                        @foreach($order->orderItems as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item->product->nama_produk }} ({{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }})
                                <span>Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                    @if($order->payment_status == 'Pending')
                        <button class="btn btn-primary btn-sm mt-3 pay-button" data-order-id="{{ $order->id }}" data-snap-token="{{ $order->snap_token }}">Bayar Sekarang</button>
                    @endif
                    <h5 class="mt-4">Status Pengiriman:</h5>
                    <p><strong>Status:</strong> {{ $order->shipping_status ?? 'Belum dikirim' }}</p>
                    @if($order->shipping_status)
                        <p><strong>Detail:</strong> {{ $order->shipping_details }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.querySelectorAll('.pay-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var snapToken = this.getAttribute('data-snap-token');
            var orderId = this.getAttribute('data-order-id');
            snap.pay(snapToken, {
                onSuccess: function(result) {
                    alert("Pembayaran berhasil!");
                    window.location.href = "/payment/success?order_id=" + orderId;
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
        });
    });
</script>
@endsection
