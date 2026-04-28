<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Commerce') — Toko Online</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')
</head>
<body>

    {{-- ── Navbar ── --}}
    <nav class="navbar">
        <a href="{{ route('home') }}" class="brand">
            <span>🛒</span> TokoOnline
        </a>

        <div class="nav-links">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.products.index') }}">📦 Kelola Produk</a>
                @endif

                <a href="{{ route('home') }}">🏠 Home</a>

                <a href="{{ route('cart.index') }}" class="nav-cart">
                    🛒 Keranjang
                    @php $cartCount = count(session('cart', [])); @endphp
                    @if($cartCount > 0)
                        <span class="nav-badge">{{ $cartCount }}</span>
                    @endif
                </a>

                <span class="nav-user">{{ auth()->user()->name }}</span>

                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>

    {{-- ── Main Content ── --}}
    <main>
        @if(session('success'))
            <div class="container" style="padding-bottom:0;">
                <div class="alert alert-success">{{ session('success') }}</div>
            </div>
        @endif

        @if($errors->any())
            <div class="container" style="padding-bottom:0;">
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
