@extends('frontend.layouts.apps')

@section('content')
<main>
    <div class="container">
        <!-- SECTION HEADER -->
        <section class="header" id="header" style="margin: 120px 0 80px 0;">
            <div class="row">
                <div class="col-12">
                    <p class="mb-3">Beranda <span>| Keranjang</span></p>
                    <h2 class="title">Halaman Keranjang</h2>
                </div>
            </div>
        </section>
        <!-- END SECTION HEADER -->

        <!-- SECTION CHECKOUT -->
        <section class="checkout" id="checkout" style="margin-bottom: 120px;">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9 order-2 order-md-1 mt-4 mt-md-0 d-flex flex-column gap-3">
                    @foreach($cartItems as $item)
                    <div class="checkout-item d-flex w-100 justify-content-between align-items-center gap-3">
                        <div class="exit-button d-flex align-items-center justify-content-center delete-item" data-id="{{ $item->id }}">
                            <img src="{{ asset('front/assets/image/icon/exit.svg') }}" alt="Exit Icon" width="20">
                        </div>
                        <img src="{{ asset('uploads/produk/' . $item->product->image) }}" alt="Product Image" class="product-image">
                        <div class="wrapper">
                            <h6 class="product-name">{{ $item->product->nama_produk }}</h6>
                            <p class="product-size">{{ $item->product->category->name }}</p>
                        </div>
                        <p class="checkout-subtotal">Rp {{ number_format($item->product->harga, 0, ',', '.') }}</p>
                        <div class="button-wrapper d-flex">
                            <button type="button" class="d-flex align-items-center justify-content-center change-quantity" data-id="{{ $item->id }}" data-quantity="{{ $item->quantity - 1 }}">-</button>
                            <button type="button" class="d-flex align-items-center justify-content-center">{{ $item->quantity }}</button>
                            <button type="button" class="d-flex align-items-center justify-content-center change-quantity" data-id="{{ $item->id }}" data-quantity="{{ $item->quantity + 1 }}">+</button>
                        </div>
                        <p class="checkout-total">Rp {{ number_format($item->product->harga * $item->quantity, 0, ',', '.') }}</p>
                    </div>
                @endforeach
                </div>
                <div class="col-12 col-md-4 col-lg-3 order-1 order-md-2">
                    <div class="card-checkout">
                        <h2 class="title" style="margin-bottom: 32px !important;">Total Belanja</h2>
                        <div class="wrapper d-flex flex-column gap-3" style="margin-bottom: 32px !important;">
                            <div class="wrapper-subtotal w-100 d-flex w-100 align-items-center justify-content-between">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($cartItems->sum(fn($item) => $item->product->harga * $item->quantity), 0, ',', '.') }}</span>
                            </div>
                            <div class="wrapper-pengiriman d-flex flex-column w-100 gap-2">
                                <span>Pengiriman</span>
                                <form class="w-100 form">
                                    <div class="input-wrapper">
                                        <select id="pengiriman" class="input w-100">
                                            <option value="0">Gratis Ongkir</option>
                                            <option value="20000">Rp. 20.000</option>
                                            <option value="40000">Rp. 40.000</option>
                                            <option value="60000">Rp. 60.000</option>
                                            <option value="80000">Rp. 80.000</option>
                                            <option value="100000">Rp. 100.000</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="wrapper-total w-100 d-flex align-items-center justify-content-between">
                                <span>Total</span>
                                <span id="total">Rp {{ number_format($cartItems->sum(fn($item) => $item->product->harga * $item->quantity), 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <a href="{{ route('checkout') }}" class="w-100 button-primary text-center">Bayar</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- END SECTION CHECKOUT -->
    </div>
</main>

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.change-quantity').on('click', function() {
            var id = $(this).data('id');
            var quantity = $(this).data('quantity');
            
            if (quantity <= 0) {
                alert('Quantity cannot be less than 1');
                return;
            }

            $.ajax({
                url: '{{ route('update.cart') }}',
                method: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    quantity: quantity
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert('Failed to update quantity.');
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again.');
                }
            });
        });

        $('.delete-item').on('click', function() {
            var id = $(this).data('id');

            $.ajax({
                url: '{{ route('delete.cart.item') }}',
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert('Failed to delete item.');
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again.');
                }
            });
        });

        $('#pengiriman').on('change', function() {
            var shippingCost = parseInt($(this).val());
            var subtotal = {{ $cartItems->sum(fn($item) => $item->product->harga * $item->quantity) }};
            var total = subtotal + shippingCost;
            $('#total').text('Rp ' + total.toLocaleString('id-ID'));
        });
    });
</script>
@endsection
@endsection
