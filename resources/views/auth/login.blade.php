@extends('layouts.app')
@section('title', 'Login')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">

        <div class="auth-logo">
            <span class="logo-icon">🔐</span>
            <h1>Selamat Datang</h1>
            <p>Masuk ke akun Toko Online Anda</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="email@contoh.com"
                       required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                       placeholder="••••••••"
                       required>
            </div>
            <button type="submit" class="btn-auth">Masuk →</button>
        </form>

        <div class="auth-divider"></div>

        <div class="auth-footer">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </div>

    </div>
</div>
@endsection
