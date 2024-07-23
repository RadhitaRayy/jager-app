@extends('frontend.layouts.apps')

@section('title', 'Detail | Jager Bakery')

@section('content')
<main>
    <div class="container">
        <!-- SECTION DETAIL PRODUCT -->
        <section class="detail-product" id="detail-product" style="margin: 120px 0;">
            <div class="row">
                <div class="col-4">
                    <img src="{{ asset('uploads/produk/' . $product->image) }}" alt="{{ $product->nama_produk }}" class="product-thumbnail mb-3">
                    <div class="scroll-image w-100">
                        <div class="wrapper-image d-flex gap-2">
                            <img src="{{ asset('uploads/produk/' . $product->image) }}" alt="{{ $product->nama_produk }}" class="product-image">
                            <!-- Ulangi atau tambahkan gambar lain jika ada -->
                        </div>
                    </div>
                    <img src="{{ asset('front/assets/image/icon/rating-review.svg') }}" alt="Rating & Review Icon" class="img-fluid" style="margin-top: 62px;">
                </div>
                <div class="col-8">
                    <div class="content-detail">
                        <div class="content-header d-flex justify-content-between align-items-start w-100" style="margin-bottom: 42px;">
                            <div class="wrapper">
                                <h5 class="detail-title" style="margin-bottom: 12px !important;">{{ $product->nama_produk }}</h5>
                                <div class="star-list d-flex gap-1 align-items-center">
                                    <img src="{{ asset('front/assets/image/icon/star.svg') }}" alt="Star Icon" width="16">
                                    <img src="{{ asset('front/assets/image/icon/star.svg') }}" alt="Star Icon" width="16">
                                    <img src="{{ asset('front/assets/image/icon/star.svg') }}" alt="Star Icon" width="16">
                                    <img src="{{ asset('front/assets/image/icon/star.svg') }}" alt="Star Icon" width="16">
                                    <img src="{{ asset('front/assets/image/icon/star.svg') }}" alt="Star Icon" width="16">
                                    <p>90 reviews</p>
                                </div>
                            </div>
                            <div class="wrapper d-flex gap-3">
                                <img src="{{ asset('front/assets/image/icon/share.svg') }}" alt="Share Icon" width="22" style="cursor: pointer;">
                                <img src="{{ asset('front/assets/image/icon/favorite.svg') }}" alt="Favorite Icon" width="22" style="cursor: pointer;">
                            </div>
                        </div>
                        <p class="description" style="margin-bottom: 32px !important;">{{ $product->deskripsi }}</p>
                        <h5 class="detail-price">Rp. {{ number_format($product->harga, 0, ',', '.') }}</h5>
                        <p class="stock-availability">{{ $product->stok > 0 ? 'In Stock' : 'Out of Stock' }}</p>
                        <div class="wrapper-quantity d-flex gap-3 align-items-center">
                            <p>Quantity</p>
                            <div class="button-wrapper d-flex">
                                <button type="button" class="d-flex align-items-center justify-content-center">-</button>
                                <button type="button" class="d-flex align-items-center justify-content-center">1</button>
                                <button type="button" class="d-flex align-items-center justify-content-center">+</button>
                            </div>
                        </div>
                        <div class="button-wrapper w-100 d-flex gap-2" style="margin-top: 62px;">
                            <a href="" class="button-primary w-100 text-center">Beli Sekarang</a>
                            <a href="#" class="button-outline w-100 text-center add-to-cart" data-product-id="{{ $product->id }}">Tambah Keranjang</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END SECTION DETAIL PRODUCT -->

        <!-- SECTION PRODUCT -->
        <section class="product" id="product" style="margin-bottom: 120px;">
            <div class="row" style="margin-bottom: 42px;">
                <div class="col-12">
                    <h2 class="title">Mungkin Anda Suka</h2>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach($recommendedProducts as $product)
                <div class="col">
                    <div class="card-product d-flex flex-column align-items-center">
                        <img src="{{ asset('uploads/produk/' . $product->image) }}" alt="{{ $product->nama_produk }}" class="product-image" style="margin-bottom: 32px;">
                        <h6 class="product-title" style="margin-bottom: 8px !important;">{{ $product->nama_produk }}</h6>
                        <p class="product-price" style="margin-bottom: 12px !important;">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                        <div class="star-list d-flex gap-1 align-items-center" style="margin-bottom: 42px;">
                            @for ($i = 0; $i < 5; $i++)
                                <img src="{{ asset('front/assets/image/icon/star.svg') }}" alt="Star Icon" width="16">
                            @endfor
                            <p>({{ $product->reviews_count ?? 0 }})</p>
                        </div>
                        <a href="{{ route('frontend.product.show', $product->id) }}" class="card-button text-center">Pesan Sekarang</a>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        <!-- END SECTION PRODUCT -->
    </div>
</main>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.add-to-cart').on('click', function(e) {
            e.preventDefault();

            var productId = $(this).data('product-id');

            $.ajax({
                url: '{{ route('add.to.cart') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    quantity: 1 // Pastikan hanya menambah 1 unit
                },
                success: function(response) {
                    if (response.success) {
                        alert('Item added to cart.');
                    } else {
                        alert('Failed to add item to cart.');
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again.');
                }
            });
        });
    });
</script>
@endsection

