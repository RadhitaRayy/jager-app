@extends('frontend.layouts.apps')

@section('content')
<style>
    .checkout-container {
        background-color: #f8e9d9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 0 auto;
        margin-top: 80px;
    }
    .checkout-title {
        font-size: 24px;
        margin-bottom: 20px;
        font-weight: bold;
    }
    .form-label {
        font-weight: bold;
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

<div class="container mt-5 mb-5">
    <div class="checkout-container">
        <h2 class="checkout-title">Checkout</h2>
        <form id="payment-form" action="{{ route('checkout.placeOrder') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Penerima</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->username) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->nomor_hp) }}" required>
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat Pengiriman</label>
                <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', $user->address) }}</textarea>
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <h4>Ringkasan Pesanan</h4>
                @foreach($cartItems as $item)
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('uploads/produk/' . $item->product->image) }}" alt="Product Image" class="img-thumbnail" width="50">
                            <div class="ms-3">
                                <h6 class="my-0">{{ $item->product->nama_produk }}</h6>
                                <small class="text-muted">{{ $item->quantity }} x Rp {{ number_format($item->product->harga, 0, ',', '.') }}</small>
                            </div>
                        </div>
                        <span>Rp {{ number_format($item->product->harga * $item->quantity, 0, ',', '.') }}</span>
                    </div>
                @endforeach
                <div class="d-flex justify-content-between align-items-center">
                    <strong>Total</strong>
                    <strong>Rp {{ number_format($cartItems->sum(fn($item) => $item->product->harga * $item->quantity), 0, ',', '.') }}</strong>
                </div>
                <input type="hidden" name="total" value="{{ $cartItems->sum(fn($item) => $item->product->harga * $item->quantity) }}">
                <input type="hidden" name="cartItems" value="{{ json_encode($cartItems) }}">
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-4">Bayar</button>
        </form>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('payment-form').onsubmit = function (event) {
    event.preventDefault();
    
    var form = this;
    var payButton = document.querySelector('.btn-primary');
    payButton.disabled = true;
    
    fetch(form.action, {
        method: form.method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            name: form.name.value,
            phone: form.phone.value,
            address: form.address.value,
            total: form.total.value,
            cartItems: form.cartItems.value
        })
    }).then(response => response.json())
    .then(data => {
        if (data.snapToken) {
            snap.pay(data.snapToken, {
                onSuccess: function(result) {
                    alert("Pembayaran berhasil!");
                    postToSuccessPage(data.order_id);
                },
                onPending: function(result) {
                    alert("Pembayaran tertunda!");
                    console.log(result);
                },
                onError: function(result) {
                    alert("Pembayaran gagal!");
                    console.log(result);
                    payButton.disabled = false;
                }
            });
        } else if (data.error) {
            alert("Gagal memproses pembayaran: " + data.error);
            payButton.disabled = false;
        } else {
            alert("Gagal memproses pembayaran. Coba lagi.");
            payButton.disabled = false;
        }
    }).catch(error => {
        console.error(error);
        alert("Terjadi kesalahan: " + error.message);
        payButton.disabled = false;
    });
};

    function postToSuccessPage(orderId) {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ route('payment.success') }}";
        
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'order_id';
        input.value = orderId;
        
        var csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        form.appendChild(input);
        form.appendChild(csrfToken);
        document.body.appendChild(form);
        form.submit();
    }
</script>
@endsection
