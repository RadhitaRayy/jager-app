@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Laporan Penjualan</h2>
    
    <form method="GET" action="{{ route('admin.reports.sales') }}">
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" name="start_date" value="{{ $startDate }}">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">Tanggal Selesai</label>
                <input type="date" class="form-control" name="end_date" value="{{ $endDate }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary btn-block">Filter</button>
            </div>
        </div>
    </form>

    <h4>Total Pendapatan: Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Nama Pengguna</th>
                <th>Total Pembayaran</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->frontendUser->username }}</td>
                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                <td>{{ $order->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
