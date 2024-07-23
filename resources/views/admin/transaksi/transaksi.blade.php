@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Daftar Transaksi</h2>
    <div class="mb-3">
        <form method="GET" action="{{ route('admin.transaksi') }}">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="search" placeholder="Cari berdasarkan nama pengguna">
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="status">
                        <option value="">Semua Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Paid">Paid</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" name="date">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Nama Pengguna</th>
                <th>Total Pembayaran</th>
                <th>Status Pembayaran</th>
                <th>Tanggal Transaksi</th>
                <th>Status Pengiriman</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->frontendUser ? $transaction->frontendUser->username : 'Pengguna tidak ditemukan' }}</td>
                <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                <td>{{ $transaction->payment_status }}</td>
                <td>{{ $transaction->created_at->format('d M Y') }}</td>
                <td>{{ $transaction->shipping_status ?? 'Belum dikirim' }}</td>
                <td>
                    <a href="{{ route('admin.transaksi.show', $transaction->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <button class="btn btn-success btn-sm update-shipping" data-id="{{ $transaction->id }}" data-status="{{ $transaction->shipping_status }}" data-details="{{ $transaction->shipping_details }}">Update Pengiriman</button>
                </td>
            @endforeach
        </tbody>
    </table>

    <!-- Modal for updating shipping status -->
    <div class="modal fade" id="updateShippingModal" tabindex="-1" aria-labelledby="updateShippingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.transaksi.update-shipping') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateShippingModalLabel">Update Status Pengiriman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="transaction_id" id="transaction_id">
                        <div class="mb-3">
                            <label for="shipping_status" class="form-label">Status Pengiriman</label>
                            <input type="text" class="form-control" id="shipping_status" name="shipping_status">
                        </div>
                        <div class="mb-3">
                            <label for="shipping_details" class="form-label">Detail Pengiriman</label>
                            <textarea class="form-control" id="shipping_details" name="shipping_details" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.update-shipping').forEach(button => {
        button.addEventListener('click', () => {
            const transactionId = button.getAttribute('data-id');
            const shippingStatus = button.getAttribute('data-status');
            const shippingDetails = button.getAttribute('data-details');

            document.getElementById('transaction_id').value = transactionId;
            document.getElementById('shipping_status').value = shippingStatus;
            document.getElementById('shipping_details').value = shippingDetails;

            new bootstrap.Modal(document.getElementById('updateShippingModal')).show();
        });
    });
</script>
@endsection
