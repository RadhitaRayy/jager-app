<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.html">
            <img src="{{ asset('front/assets/image/brand/brand-logo.svg') }}" alt="Brand Logo" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                <a class="nav-link {{ request()->is('kategori') ? 'active' : '' }}" href="{{ url('/kategori') }}">Kategori</a>
                <a class="nav-link {{ request()->is('produk') ? 'active' : '' }}" href="{{ url('/produk') }}">Produk</a>
                <a class="nav-link {{ request()->is('testimonials') ? 'active' : '' }}" href="{{ url('/testimonials') }}">Testimoni</a>
            </div>
        </div>
        <div class="navbar-side d-none d-lg-flex align-items-center gap-4">
            <div class="side-search d-flex align-items-center gap-2">
                <img src="{{ asset('front/assets/image/icon/search.svg') }}" alt="Search Icon" width="20">
                <input type="search" placeholder="Cari.." class="input-navbar">
            </div>
            <div class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('front/assets/image/icon/cart.svg') }}" alt="Cart Icon" width="20">
                    <span id="cart-count" class="badge badge-pill badge-danger">{{ count($cartItems) }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right p-3" aria-labelledby="navbarDropdown" style="width: 300px;">
                    <h6 class="dropdown-header">Keranjang ({{ count($cartItems) }})</h6>
                    <div id="cart-items">
                        @foreach($cartItems as $item)
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{ asset('uploads/produk/' . $item->product->image) }}" alt="Product Image" class="img-thumbnail" width="50">
                                <div class="ml-2">
                                    <h6 class="my-0">{{ $item->product->nama_produk }}</h6>
                                    <small class="text-muted">{{ $item->product->category->name }}</small>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">{{ $item->quantity }} x Rp {{ number_format($item->product->harga, 0, ',', '.') }}</span>
                                        @if($item->product->original_price)
                                            <span class="text-muted"><del>Rp {{ number_format($item->product->original_price, 0, ',', '.') }}</del></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('show.cart') }}" class="btn btn-primary btn-block">Lihat Keranjang</a>
                </div>
            </div>
            @if(Auth::guard('frontend')->check())
            @php
                $user = Auth::guard('frontend')->user();
            @endphp
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $user ? $user->username : 'Guest' }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('order.history') }}">Riwayat Pesanan</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('frontend.logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            <a href="#" class="live-chat">
                <img src="{{ asset('front/assets/image/icon/contact.svg') }}" alt="Live Chat Icon" width="20">
            </a>
            @else
            <button type="button" class="side-profile d-flex align-items-end gap-3" data-bs-toggle="modal" data-bs-target="#loginModal">
                <p>Login</p>
            </button>
            <a href="#" class="live-chat">
                <img src="{{ asset('front/assets/image/icon/contact.svg') }}" alt="Live Chat Icon" width="20">
            </a>
            @endif
        </div>
    </div>
</nav>
<!-- END NAVBAR -->
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.nav-item.dropdown').hover(function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
        }, function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
        });
    });
</script>
@endsection