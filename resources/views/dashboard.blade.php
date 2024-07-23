@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="home-tab">
            <!-- Grafik Penjualan Bulanan -->
            <div class="row">
                <div class="col-lg-8 d-flex flex-column">
                    <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                        <div>
                                            <h4 class="card-title card-title-dash">Market Overview</h4>
                                            <p class="card-subtitle card-subtitle-dash">Penjualan dari toko online Anda</p>
                                        </div>
                                        <div>
                                            <div class="dropdown">
                                                <button class="btn btn-light dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{ ucfirst($filter) }}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                    <a class="dropdown-item" href="#">Monthly</a>
                                                    <a class="dropdown-item" href="#">Weekly</a>
                                                    <a class="dropdown-item" href="#">Yearly</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                        <div class="d-sm-flex align-items-center mt-4 justify-content-between">
                                            <h2 class="me-2 fw-bold">Rp {{ number_format($sales->sum('total'), 0, ',', '.') }}</h2>
                                            <h4 class="me-2">IDR</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Your dashboard content -->
            <div class="row">
                <div class="col-md-6 d-flex flex-column">
                    <div class="row flex-grow">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card card-rounded" style="max-width: 300px; margin: auto;">
                                <div class="card-body">
                                    <!-- Add this section for total categories -->
                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <a href="{{ route('categories.index') }}" class="text-decoration-none">
                                                <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 100px;">
                                                    <p class="text-small mb-1">Total Kategori</p>
                                                    <h4 class="mb-0 fw-bold text-center">{{ $totalCategories }}</h4>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- End of section -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 d-flex flex-column">
                    <div class="row flex-grow">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card card-rounded" style="max-width: 300px; margin: auto;">
                                <div class="card-body">
                                    <!-- Add this section for total products -->
                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <a href="{{ route('products.index') }}" class="text-decoration-none">
                                                <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 100px;">
                                                    <p class="text-small mb-1">Total Produk</p>
                                                    <h4 class="mb-0 fw-bold text-center">{{ $totalProducts }}</h4>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- End of section -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of your dashboard content -->
        </div>
    </div>
</div>
@endsection
