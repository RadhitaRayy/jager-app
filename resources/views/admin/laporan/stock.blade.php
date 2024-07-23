@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Laporan Stok Barang</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->nama_produk }}</td>
                <td>{{ $product->stok }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
