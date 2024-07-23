@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Tabel Kategori -->
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Tabel Kategori</h4>
          <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary" title="Tambah Kategori">
                <i class="mdi mdi-plus-circle"></i> Tambah Kategori
            </a>
          </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kategori</th>
                  <th>Gambar</th>
                  <th style="max-width: 150px;">Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $key => $category)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $category->nama_kategori }}</td>
                    <td>
                        @if($category->gambar)
                        <img src="{{ asset('uploads/kategori/' . $category->gambar) }}" alt="{{ $category->nama_kategori }}" width="50">
                        @endif
                    </td>
                    <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis;" title="{{ $category->ket }}">{{ $category->ket }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-inverse-primary" title="Edit">
                          <i class="mdi mdi-pencil"></i>
                        </a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
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
                text: "Anda tidak akan dapat mengembalikan ini!",
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
