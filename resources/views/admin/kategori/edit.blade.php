@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Edit Kategori</h4>
                <form method="post" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data" id="form-edit-kategori">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ $category->nama_kategori }}" placeholder="Nama Kategori">
                    </div>
                    <div class="form-group">
                        <label>Tambah Gambar</label>
                        <input type="file" name="gambar" id="gambar" class="form-control">
                        @if($category->gambar)
                            <img src="{{ asset('uploads/kategori/' . $category->gambar) }}" alt="{{ $category->nama_kategori }}" width="50">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="ket">Keterangan Kategori</label>
                        <input type="text" class="form-control" id="ket" name="ket" value="{{ $category->ket }}" placeholder="Keterangan">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                    <button type="reset" class="btn btn-light">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
