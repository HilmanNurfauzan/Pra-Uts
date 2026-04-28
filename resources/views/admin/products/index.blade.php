@extends('layouts.app')
@section('title', 'Kelola Produk')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="container">

    <div class="admin-header">
        <div>
            <h1>📦 Kelola Produk</h1>
            <p>{{ $products->count() }} produk terdaftar</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-add">+ Tambah Produk</a>
    </div>

    @if($products->count() > 0)
        <div class="table-wrapper">
            <table class="product-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $index => $product)
                        <tr>
                            <td class="row-num">{{ $index + 1 }}</td>
                            <td class="product-name">{{ $product->name }}</td>
                            <td class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td><span class="stock">{{ $product->stock }}</span></td>
                            <td>
                                @forelse($product->categories as $category)
                                    <span class="badge">{{ $category->name }}</span>
                                @empty
                                    <span style="color:#334155; font-size:12px;">—</span>
                                @endforelse
                            </td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit">✏️ Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                      style="display:inline;"
                                      onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">📦</div>
            <p>Belum ada produk. <a href="{{ route('admin.products.create') }}" style="color:#818cf8;">Tambah sekarang</a></p>
        </div>
    @endif

</div>
@endsection
