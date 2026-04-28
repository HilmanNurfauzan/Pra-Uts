@extends('layouts.app')
@section('title', 'Tambah Produk')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="container">

    <a href="{{ route('admin.products.index') }}" class="btn-back">← Kembali ke Daftar Produk</a>

    <div class="form-card">
        <h2>➕ Tambah Produk Baru</h2>

        <form method="POST" action="{{ route('admin.products.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" id="name" name="name"
                       value="{{ old('name') }}"
                       placeholder="Masukkan nama produk"
                       required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description"
                          placeholder="Deskripsi produk (opsional)">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Harga (Rp)</label>
                <input type="number" id="price" name="price"
                       value="{{ old('price') }}"
                       placeholder="Contoh: 150000"
                       min="0" step="1" required>
            </div>

            <div class="form-group">
                <label for="stock">Stok</label>
                <input type="number" id="stock" name="stock"
                       value="{{ old('stock', 0) }}"
                       min="0" required>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <div class="checkbox-group">
                    @foreach($categories as $category)
                        <label class="checkbox-label">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                            {{ $category->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn-submit">Simpan Produk</button>
        </form>
    </div>

</div>
@endsection
