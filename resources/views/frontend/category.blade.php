@extends('frontend.layouts.apps')

@section('title', 'Kategori | Jager Bakery')

@section('content')
    <main>
        <div class="container">
            <section class="category" id="category" style="margin: 120px 0;">
                <div class="row" style="margin-bottom: 42px;">
                    <div class="col-12 text-center">
                        <h2 class="title">Kategori Jäger Bakery</h2>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach($categories as $category)
                        <div class="col">
                            <a href="{{ route('frontend.by_category', $category->id) }}" class="card-category d-flex align-items-center gap-3">
                                <img src="{{ asset('uploads/kategori/' . $category->gambar) }}" alt="Category Image" class="category-image">
                                <div class="category-content text-center">
                                    <h6 style="margin-bottom: 4px;">{{ $category->nama_kategori }}</h6>
                                    <p>{{ $category->ket }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </main>
@endsection 
