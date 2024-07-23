@extends('layouts.app')

@section('content')
<!-- Form Tambah Produk -->
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Form Tambah Produk</h4>
        <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data" id="form-tambah-produk">
            @csrf
            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk" required>
            </div>
            <div class="form-group">
                <label for="kategori_id">Kategori</label>
                <select class="form-control" id="kategori_id" name="kategori_id" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Tambah Gambar</label>
                <input type="file" name="gambar" id="gambar" class="form-control">
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" required>
                </div>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi">
            </div>
            <button type="submit" class="btn btn-primary me-2">Simpan</button>
            <button type="reset" class="btn btn-light">Batal</button>
        </form>
      </div>
    </div>
  </div>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- SweetAlert untuk pesan setelah submit form -->
@if(Session::has('toast_success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ Session::get('toast_success') }}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif
@endsection