@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Detail Transaksi</h2>
    <div class="card">
        <div class="card-header">
            <strong>Order ID:</strong> {{ $transaction->id }}
            <span class="float-right"><strong>Tanggal:</strong> {{ $transaction->created_at->format('d M Y') }}</span>
        </div>
        <div class="card-body">
            <p><strong>Nama Pengguna:</strong> {{ $transaction->frontendUser ? $transaction->frontendUser->name : 'Pengguna tidak ditemukan' }}</p>
            <p><strong>Total Pembayaran:</strong> Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
            <p><strong>Status Pembayaran:</strong> {{ $transaction->payment_status }}</p>
            <p><strong>Status Pengiriman:</strong> {{ $transaction->shipping_status ?? 'Belum dikirim' }}</p>
            <p><strong>Detail Pengiriman:</strong> {{ $transaction->shipping_details }}</p>
            
            <h5 class="mt-4">Item yang Dibeli:</h5>
            <ul class="list-group">
                @foreach($transaction->orderItems as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $item->product->nama_produk }} ({{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }})
                        <span>Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.transaksi') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
