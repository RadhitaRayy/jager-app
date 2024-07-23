@extends('layouts.app')
@section('content')
<!-- Form Tambah Kategori -->
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Form Tambah Kategori</h4>
        <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data" id="form-tambah-kategori">
            @csrf
            <div class="form-group">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Nama Kategori">
            </div>
            <div class="form-group">
                <label>Tambah Gambar</label>
                <input type="file" name="gambar" id="gambar" class="form-control">
            </div>
            <div class="form-group">
                <label for="ket">Keterangan Kategori</label>
                <input type="text" class="form-control" id="ket" name="ket" placeholder="Keterangan">
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