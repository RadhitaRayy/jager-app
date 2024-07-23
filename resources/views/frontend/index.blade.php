@extends('frontend.layouts.apps')

@section('content')
    <!-- MODAL LOGIN -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="body-header d-flex flex-column align-items-end justify-content-center text-center" style="margin-bottom: 42px;">
                        <div class="exit-button d-flex align-items-center justify-content-center" data-bs-dismiss="modal">
                            <img src="{{ asset('front/assets/image/icon/exit.svg') }}" alt="Exit Icon" width="20">
                        </div>
                        <h4 class="body-title w-100" style="margin-bottom: 8px !important;">Selamat Datang, Silahkan Login</h4>
                        <p class="body-redirect w-100">Belum Punya Akun? <button type="button" data-bs-toggle="modal" data-bs-target="#registerModal">Buat Disini</button></p>
                    </div>
                    <form class="w-100 form d-flex flex-column gap-4" method="POST" action="{{ route('frontend.login') }}">
                        @csrf
                        <div class="input-wrapper d-flex gap-2 flex-column">
                            <label for="login" class="w-100">Username atau Email</label>
                            <input type="text" id="login" name="login" class="input" placeholder="Masukkan Username atau Email" required>
                        </div>
                        <div class="input-wrapper d-flex gap-2 flex-column align-items-end">
                            <label for="password" class="w-100">Password</label>
                            <input type="password" id="password" name="password" class="input w-100" placeholder="Masukkan Password Akun" required>
                            <a href="" class="link-forget">Forget your password?</a>
                        </div>
                        <button type="submit" class="button-primary button-red w-100 text-center" id="loginButton">Login</button>
                        <div class="other-wrapper position-relative text-center w-100">
                            <div class="other-line"></div>
                            <p class="other">or</p>
                        </div>
                        <div class="button-group w-100 d-flex justify-content-between">
                            <button type="button" class="button-sosmed d-flex align-items-center gap-2">
                                <img src="{{ asset('front/assets/image/social-media/google.svg') }}" alt="Google Icon" width="24">
                                Google
                            </button>
                            <button type="button" class="button-sosmed d-flex align-items-center gap-2">
                                <img src="{{ asset('front/assets/image/social-media/facebook.svg') }}" alt="Facebook Icon" width="24">
                                Facebook
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL LOGIN -->


    <!-- MODAL REGISTER -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="body-header d-flex flex-column align-items-end justify-content-center text-center" style="margin-bottom: 12px;">
                        <div class="exit-button d-flex align-items-center justify-content-center" data-bs-dismiss="modal">
                            <img src="{{ asset('front/assets/image/icon/exit.svg') }}" alt="Exit Icon" width="20">
                        </div>
                        <h4 class="body-title w-100">Buat Akun</h4>
                    </div>
                    <form id="registerForm" class="w-100 form d-flex flex-column gap-4" action="{{ route('frontend.register') }}" method="POST">
                        @csrf
                        <div class="input-wrapper d-flex gap-2 flex-column">
                            <label for="email" class="w-100">Email</label>
                            <input type="email" id="email" name="email" class="input" placeholder="Masukkan Email Anda">
                        </div>
                        <div class="input-wrapper d-flex gap-2 flex-column">
                            <label for="nomor_hp" class="w-100">Nomor Hp</label>
                            <input type="text" id="nomor_hp" name="nomor_hp" class="input" placeholder="Masukkan Nomor Hp Anda">
                        </div>
                        <div class="input-wrapper d-flex gap-2 flex-column">
                            <label for="username" class="w-100">Username</label>
                            <input type="text" id="username" name="username" class="input" placeholder="Masukkan Username Anda">
                        </div>
                        <div class="input-wrapper d-flex gap-2 flex-column align-items-end">
                            <label for="password" class="w-100">Password</label>
                            <input type="password" id="password" name="password" class="input w-100" placeholder="Masukkan Password Anda">
                        </div>
                        <button type="submit" class="button-primary button-red w-100 text-center">Register</button>
                        <div class="other-wrapper position-relative text-center w-100">
                            <div class="other-line"></div>
                            <p class="other">or</p>
                        </div>
                        <div class="button-group w-100 d-flex justify-content-between">
                            <button type="button" class="button-sosmed d-flex align-items-center gap-2">
                                <img src="{{ asset('front/assets/image/social-media/google.svg') }}" alt="Google Icon" width="24">
                                Google
                            </button>
                            <button type="button" class="button-sosmed d-flex align-items-center gap-2">
                                <img src="{{ asset('front/assets/image/social-media/facebook.svg') }}" alt="Facebook Icon" width="24">
                                Facebook
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL REGISTER -->

    <main>
        <div class="container">
            <!-- SECTION HERO -->
            <section class="hero position-relative" id="hero" style="height: 100vh; margin-bottom: 120px;">
                <img src="{{ asset('front/assets/image/other/wave-hero-1.svg') }}" alt="Wave Image" class="wave-image-first">
                <img src="{{ asset('front/assets/image/other/wave-hero-2.svg') }}" alt="Wave Image" class="wave-image-second">
                <div class="row align-items-center position-relative" style="height: 100vh;">
                    <div class="col-lg-6">
                        <h1 class="headline" style="margin-bottom: 32px !important;">Jäger Bakery</h1>
                        <p class="description" style="margin-bottom: 32px !important;">Tersenyumlah, karena setiap gigitan adalan petualangan rasa dari Jäger Bakery yang tak terlupakan.
                            <br> -JägerBakery2024-</p>
                        <a href="product.html" class="button-primary" style="margin-bottom: 32px !important;">Belanja Sekarang</a>
                        <div class="benefit-list d-flex flex-column gap-2">
                            <div class="list d-flex gap-2 align-items-center">
                                <img src="{{ asset('front/assets/image/icon/check.svg') }}" alt="Check Icon" width="16">
                                <p>Roti Yang Berkualitas</p>
                            </div>
                            <div class="list d-flex gap-2 align-items-center">
                                <img src="{{ asset('front/assets/image/icon/check.svg') }}" alt="Check Icon" width="16">
                                <p>Harga Terbaik</p>
                            </div>
                            <div class="list d-flex gap-2 align-items-center">
                                <img src="{{ asset('front/assets/image/icon/check.svg') }}" alt="Check Icon" width="16">
                                <p>Layanan Yang Berkualitas</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 d-none d-lg-inline-block">
                        <img src="{{ asset('front/assets/image/section-hero/banner.png') }}" alt="Banner Hero" class="img-fluid">
                    </div>
                </div>
            </section>
            <!-- END SECTION HERO -->


            <!-- SECTION PRODUCT -->
            <section class="product" id="product" style="margin-bottom: 120px;">
                <div class="row" style="margin-bottom: 42px;">
                    <div class="col-12 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 gap-md-0">
                        <h2 class="title">Produk Unggulan</h2>
                        <select class="select-option">
                            <option value="">Default sorting</option>
                            <option value="">Sort by Latest</option>
                            <option value="">Sort by popularity</option>
                            <option value="">Sort by average rating</option>
                        </select>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    @foreach($products as $product)
                    <div class="col">
                        <div class="card-product d-flex flex-column align-items-center">
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
                            <a href="{{ route('frontend.product.show', $product->id) }}" class="card-button text-center">Pesan Sekarang</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            <!-- END SECTION PRODUCT -->


            <!-- SECTION TESTIMONIAL -->
        <section class="testimonial" id="testimonial" style="margin: 120px 0;">
            <div class="row" style="margin-bottom: 42px;">
                <div class="col-12">
                    <h2 class="title">Apa yang Mereka katakan</h2>
                </div>
            </div>
            <div style="margin-bottom: 32px;" class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($testimonials as $testimonial)
                <div class="col">
                    <div class="card-testimonial">
                        <div class="testimonial-header d-flex justify-content-between" style="margin-bottom: 12px !important;">
                            <img src="{{ $testimonial->image ? asset($testimonial->image) : 'assets/image/testimonial/default.jpg' }}" alt="Testimonial Image" class="testimonial-image">
                            <p class="testimonial-date">{{ $testimonial->created_at->format('M d, Y') }}</p>
                        </div>
                        <h6 class="testimonial-name" style="margin-bottom: 6px !important;">{{ $testimonial->name }}</h6>
                        <div class="star-list d-flex gap-1 align-items-center" style="margin-bottom: 12px;">
                            @for($i = 0; $i < $testimonial->rating; $i++)
                            <img src="{{ asset('front/assets/image/icon/star.svg') }}" alt="Star Icon" width="16">
                            @endfor
                        </div>
                        <p class="testimonial-message">{{ $testimonial->message }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        <!-- END SECTION TESTIMONIAL -->


            <!-- SECTION FAQ -->
            <section class="faq" id="faq" style="margin-bottom: 120px;">
                <div class="row" style="margin-bottom: 42px;">
                    <div class="col-12">
                        <h2 class="title">Pertanyaaan yang sering ditanyakan</h2>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-6 d-none d-lg-inline-block">
                        <img src="assets/image/section-faq/banner.png" alt="Banner CTA" class="img-fluid">
                    </div>
                    <div class="col-lg-6">
                        <div class="faq-list">
                            <div class="list-item d-flex justify-content-between align-items-center gap-4">
                                <div class="item-body">
                                    <h6>Bagaimana cara memesan kue?</h6>
                                </div>
                                <p>+</p>
                            </div>
                            <div class="list-item d-flex justify-content-between align-items-center gap-4">
                                <div class="item-body">
                                    <h6>Metode pembayaran apa saja yang diterima?</h6>
                                    <p style="margin-top: 8px;">Kami menerima pembayaran melalui transfer bank, kartu kredit, dan beberapa metode pembayaran online seperti e-wallet.</p>
                                </div>
                                <p>-</p>
                            </div>
                            <div class="list-item d-flex justify-content-between align-items-center gap-4">
                                <div class="item-body">
                                    <h6>Bagaimana cara menghubungi layanan pelanggan?</h6>
                                </div>
                                <p>+</p>
                            </div>
                            <div class="list-item d-flex justify-content-between align-items-center gap-4">
                                <div class="item-body">
                                    <h6>Bagaimana cara untuk melakukan registrasi akun?</h6>
                                </div>
                                <p>+</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END SECTION CTA -->
        </div>
    </main> 
@endsection

@section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const registerForm = document.getElementById('registerForm');

            registerForm.addEventListener('submit', function(event) {
                event.preventDefault();

                // Kirim form menggunakan Ajax
                fetch(registerForm.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        email: registerForm.email.value,
                        nomor_hp: registerForm.nomor_hp.value,
                        username: registerForm.username.value,
                        password: registerForm.password.value,
                        password_confirmation: registerForm.password_confirmation ? registerForm.password_confirmation.value : ''
                    })
                }).then(response => {
                    if (response.ok) {
                        // Tutup modal register
                        $('#registerModal').modal('hide');
                        
                        // Tunggu sampai modal register benar-benar tertutup
                        $('#registerModal').on('hidden.bs.modal', function () {
                            // Buka modal login
                            $('#loginModal').modal('show');
                        });
                    } else {
                        return response.json().then(data => {
                            // Tampilkan error jika ada
                            alert(data.message);
                        });
                    }
                }).catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Tambahkan fragmen #!/ jika tidak ada
            if (!window.location.hash) {
                window.location.href = window.location.pathname + '#!/';
            }

            // Tambahkan event listener untuk link navigasi
            document.querySelectorAll('a.nav-link').forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Mencegah navigasi default
                    let targetUrl = new URL(event.currentTarget.href);
                    if (!targetUrl.hash.includes('#!/')) {
                        targetUrl.hash = '#!/';
                    }
                    window.location.href = targetUrl.href;
                });
            });

            // Handle login form submission
            const loginForm = document.getElementById('loginForm');
            if (loginForm) {
                loginForm.addEventListener('submit', function(event) {
                    event.preventDefault(); // Mencegah submit default
                    const action = loginForm.action;
                    const formData = new FormData(loginForm);
                    
                    fetch(action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Ganti URL dengan fragmen
                            window.location.href = '/#!/';
                        } else {
                            // Tampilkan pesan error
                            console.log('Login gagal');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            }
        });
    </script>
@endsection