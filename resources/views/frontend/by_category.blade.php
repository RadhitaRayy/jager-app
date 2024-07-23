@extends('frontend.layouts.apps')

@section('title', 'Produk Kategori | Jager Bakery')

@section('content')
<main>
    <div class="container">
        <!-- SECTION HEADER -->
        <section class="header" id="header" style="margin: 120px 0 80px 0;">
            <div class="row">
                <div class="col-12">
                    <p class="mb-3">Beranda <span>| Produk</span></p>
                    <h2 class="title">Produk dalam Kategori: {{ $category->nama_kategori }}</h2>
                </div>
            </div>
        </section>
        <!-- END SECTION HEADER -->

        <!-- SECTION PRODUCT -->
        <section class="product" id="product" style="margin-bottom: 120px;">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9 order-2 order-md-1 mt-4 mt-md-0">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach ($products as $product)
                        <div class="col">
                            <a href="{{ route('frontend.product.show', $product->id) }}" class="card-product d-flex flex-column align-items-center">
                                <img src="{{ asset('uploads/produk/' . $product->image) }}" alt="Product Image" class="product-image" style="margin-bottom: 32px;">
                                <h6 class="product-title" style="margin-bottom: 8px !important;">{{ $product->nama_produk }}</h6>
                                <p class="product-price" style="margin-bottom: 12px !important;">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                                <div class="star-list d-flex gap-1 align-items-center" style="margin-bottom: 42px;">
                                    <img src="{{ asset('front/assets/image/icon/star.svg') }}" alt="Star Icon" width="16">
                                    <img src="{{ asset('front/assets/image/icon/star.svg') }}" alt="Star Icon" width="16">
                                    <img src="{{ asset('front/assets/image/icon/star.svg') }}" alt="Star Icon" width="16">
                                    <img src="{{ asset('front/assets/image/icon/star.svg') }}" alt="Star Icon" width="16">
                                    <img src="{{ asset('front/assets/image/icon/star.svg') }}" alt="Star Icon" width="16">
                                    <p>( 990 )</p>
                                </div>
                                <button type="button" class="card-button text-center">Pesan Sekarang</button>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 order-1 order-md-2">
                    <div class="wrapper d-flex flex-column gap-3 w-100">
                        <form action="{{ route('frontend.product.index') }}" method="GET">
                            <div class="input-search d-flex align-items-center gap-2">
                                <input type="search" name="search" placeholder="Search…" class="input" value="{{ request()->search }}">
                                <img src="{{ asset('front/assets/image/icon/search.svg') }}" alt="Search Icon" class="search-icon" width="16">
                            </div>
                        </form>
                        <div class="category-list d-flex flex-column gap-2">
                            <a href="{{ route('frontend.product.index') }}" class="d-flex w-100 align-items-center justify-content-between {{ request()->category ? '' : 'active' }}">
                                <span>All</span>
                                <span>#</span>
                            </a>
                            @foreach ($categories as $category)
                            <a href="{{ route('frontend.product.index', ['category' => $category->id]) }}" class="d-flex w-100 align-items-center justify-content-between {{ request()->category == $category->id ? 'active' : '' }}">
                                <span>{{ $category->nama_kategori }}</span>
                                <span>({{ $category->products->count() }})</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END SECTION PRODUCT -->
    </div>
</main>
@endsection
