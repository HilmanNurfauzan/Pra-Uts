@extends('layouts.app')
@section('title', 'Home')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')

{{-- ── Hero ── --}}
<div class="home-hero">
    <h1>Temukan Produk <span class="gradient-text">Terbaik</span> Anda</h1>
    <p>Belanja mudah, cepat, dan terpercaya di Toko Online kami</p>
</div>

{{-- ── Stats strip ── --}}
<div class="container" style="padding-top:0; padding-bottom:0;">
    <div class="stats-strip">
        <div class="stat-item">
            <div class="stat-num">{{ $products->count() }}</div>
            <div class="stat-label">Produk</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">{{ $products->pluck('categories')->flatten()->unique('id')->count() }}</div>
            <div class="stat-label">Kategori</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">{{ $products->sum('stock') }}</div>
            <div class="stat-label">Stok Tersedia</div>
        </div>
    </div>
</div>

{{-- ── Products ── --}}
<div class="container">
    @if($products->count() > 0)
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <div class="product-icon">🛍️</div>

                    <h3 class="product-name">{{ $product->name }}</h3>
                    <p class="product-desc">{{ $product->description ?? 'Tidak ada deskripsi.' }}</p>

                    <div class="product-price">
                        <sup>Rp</sup>{{ number_format($product->price, 0, ',', '.') }}
                    </div>

                    <p class="product-stock {{ $product->stock <= 5 ? 'low' : '' }}">
                        Stok: {{ $product->stock }}{{ $product->stock <= 5 ? ' ⚠️ Hampir habis' : '' }}
                    </p>

                    <div class="product-categories">
                        @forelse($product->categories as $category)
                            <span class="badge">{{ $category->name }}</span>
                        @empty
                            <span class="badge" style="background:rgba(100,116,139,0.2); color:#64748b; border-color:rgba(100,116,139,0.2);">Umum</span>
                        @endforelse
                    </div>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-cart">
                            🛒 Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">📦</div>
            <h3>Belum ada produk</h3>
            <p>Produk belum tersedia saat ini.</p>
        </div>
    @endif
</div>

@endsection
