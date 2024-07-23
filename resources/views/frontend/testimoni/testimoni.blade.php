@extends('frontend.layouts.apps')

@section('content')
<main>
    <div class="container">
        <!-- SECTION TESTIMONIAL -->
        <section class="testimonial" id="testimonial" style="margin: 120px 0;">
            <div class="row" style="margin-bottom: 42px;">
                <div class="col-12">
                    <h2 class="title">Apa yang Mereka katakan</h2>
                </div>
            </div>
            <div class="testimonial-slider" style="margin-bottom: 32px;">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach($testimonials as $testimonial)
                    <div class="col testimonial-item">
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
            </div>
            <div class="row">
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <div class="arrow-side d-flex gap-2">
                        <div class="side-button prev d-flex align-items-center justify-content-center">
                            <img src="{{ asset('front/assets/image/icon/arrow-dark.svg') }}" alt="Arrow Dark" width="20">
                        </div>
                        <div class="side-button next d-flex align-items-center justify-content-center">
                            <img src="{{ asset('front/assets/image/icon/arrow-dark.svg') }}" alt="Arrow Dark" width="20">
                        </div>
                    </div>
                    <div class="pagination-side d-flex gap-2">
                        @for ($i = 0; $i < ceil(count($testimonials) / 2); $i++)
                        <div class="side-bullet {{ $i == 0 ? 'active' : '' }}" data-index="{{ $i }}"></div>
                        @endfor
                    </div>
                </div>
            </div>
        </section>
        <!-- END SECTION TESTIMONIAL -->

        <!-- INPUT SECTION TESTIMONIAL -->
        <section class="input-testimonial" id="input-testimonial" style="margin-bottom: 120px;">
            <div class="row" style="margin-bottom: 42px;">
                <div class="col-12">
                    <h2 class="title">Tambahkan Testimoni Anda di Sini!</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form class="w-100 form position-relative" action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-wrapper position-relative mb-4">
                            <input type="text" class="input w-100" name="name" placeholder="Nama Anda" required>
                        </div>
                        <div class="input-wrapper position-relative mb-4">
                            <input type="email" class="input w-100" name="email" placeholder="Email Anda (opsional)">
                        </div>
                        <div class="input-wrapper position-relative mb-4">
                            <input type="file" class="input w-100" name="image" accept="image/*">
                        </div>
                        <div class="input-wrapper position-relative mb-4">
                            <select class="input w-100" name="rating" required>
                                <option value="" disabled selected>Rating</option>
                                <option value="1">1 Bintang</option>
                                <option value="2">2 Bintang</option>
                                <option value="3">3 Bintang</option>
                                <option value="4">4 Bintang</option>
                                <option value="5">5 Bintang</option>
                            </select>
                        </div>
                        <div class="input-wrapper position-relative mb-4">
                            <textarea class="input w-100" name="message" rows="10" placeholder="Silakan tuliskan di sini" required></textarea>
                        </div>
                        <button type="submit" class="button-primary">Submit</button>
                    </form>
                </div>
            </div>
        </section>
        <!-- END INPUT SECTION TESTIMONIAL -->
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
        $(document).ready(function() {
            let currentIndex = 0;
            const testimonialsPerPage = 2;
            const totalPages = Math.ceil($('.testimonial-item').length / testimonialsPerPage);

            function showTestimonials(index) {
                $('.testimonial-item').hide();
                $('.testimonial-item').slice(index * testimonialsPerPage, (index + 1) * testimonialsPerPage).show();
            }

            function setActiveBullet(index) {
                $('.side-bullet').removeClass('active');
                $(`.side-bullet[data-index="${index}"]`).addClass('active');
            }

            $('.side-button.prev').click(function() {
                if (currentIndex > 0) {
                    currentIndex--;
                    showTestimonials(currentIndex);
                    setActiveBullet(currentIndex);
                }
            });

            $('.side-button.next').click(function() {
                if (currentIndex < totalPages - 1) {
                    currentIndex++;
                    showTestimonials(currentIndex);
                    setActiveBullet(currentIndex);
                }
            });

            $('.side-bullet').click(function() {
                const index = $(this).data('index');
                currentIndex = index;
                showTestimonials(currentIndex);
                setActiveBullet(currentIndex);
            });

            showTestimonials(currentIndex);
        });
    </script>
@endsection
