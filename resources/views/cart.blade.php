@extends('layouts.app')
@section('title', 'Keranjang Belanja')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')
<div class="container">

    <div class="cart-header">
        <span style="font-size:32px;">🛒</span>
        <div>
            <h1>Keranjang Belanja</h1>
            <p style="font-size:13px; color:#64748b;">
                {{ count($cartItems) }} item dalam keranjang Anda
            </p>
        </div>
    </div>

    @if(count($cartItems) > 0)
        <div class="cart-layout">

            {{-- ── Items Table ── --}}
            <div class="cart-table-wrapper">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Jml</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr>
                                <td class="cart-product-name">{{ $item['product']->name }}</td>
                                <td>
                                    @foreach($item['product']->categories as $cat)
                                        <span class="badge">{{ $cat->name }}</span>
                                    @endforeach
                                </td>
                                <td class="cart-price">Rp {{ number_format($item['product']->price, 0, ',', '.') }}</td>
                                <td><span class="cart-qty">{{ $item['quantity'] }}</span></td>
                                <td class="cart-subtotal">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-remove">🗑️ Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- ── Order Summary ── --}}
            <div class="order-summary">
                <h3>Ringkasan Pesanan</h3>

                @foreach($cartItems as $item)
                    <div class="summary-row">
                        <span>{{ $item['product']->name }} ×{{ $item['quantity'] }}</span>
                        <span>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                    </div>
                @endforeach

                <div class="summary-row total">
                    <span>Total</span>
                    <span class="amount">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>

        </div>

    @else
        <div class="empty-cart">
            <div class="empty-icon">🛒</div>
            <h3>Keranjang masih kosong</h3>
            <p>Belum ada produk yang ditambahkan ke keranjang.</p>
            <a href="{{ route('home') }}" class="btn-shop">🛍️ Mulai Belanja</a>
        </div>
    @endif

</div>
@endsection
