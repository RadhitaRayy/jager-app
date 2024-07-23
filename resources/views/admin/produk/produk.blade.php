@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Tabel Produk -->
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Tabel Produk</h4>
          <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary" title="Tambah Produk">
                <i class="mdi mdi-plus-circle"></i> Tambah Produk
            </a>
          </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Produk</th>
                  <th>Kategori</th>
                  <th>Gambar</th>
                  <th>Harga</th>
                  <th>Stok</th>
                  <th style="max-width: 150px;">Deskripsi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($products as $product)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $product->nama_produk }}</td>
                  <td>{{ $product->category->nama_kategori }}</td>
                  <td>
                    @if($product->image)
                    <img src="{{ asset('uploads/produk/' . $product->image) }}" alt="{{ $product->nama_produk }}" width="50">
                    @endif
                </td>
                  <td>{{ $product->harga }}</td>
                  <td>{{ $product->stok }}</td>
                  <td>{{ $product->deskripsi }}</td>
                  <td>
                    <a href="#" class="btn btn-sm btn-inverse-primary" title="Edit">
                      <i class="mdi mdi-pencil"></i>
                    </a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-sm btn-inverse-danger delete-btn" title="Hapus">
                          <i class="mdi mdi-delete"></i>
                      </button>
                  </form>
                </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
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
<script>
    $(document).ready(function() {
        $('.delete-btn').click(function() {
            var form = $(this).closest('form');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda Akan Menghapus Ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
