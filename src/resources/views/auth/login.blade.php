@extends('layouts.auth')

@section('header-link')
    <a href="/register" class="header-btn">register</a>
@endsection

@section('content')
    <div class="auth-card">
        <h2 class="auth-title">Login</h2>
        <form action="/login" method="POST" class="auth-form" novalidate>
            @csrf
            <div class="form-group">
                <label>メールアドレス</label>
                <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                @error('email') <p class="error">{{ $message }}</p> @enderror
            </div>
            <div class="form-group">
                <label>パスワード</label>
                <input type="password" name="password" placeholder="例: coachtech1106" autocomplete="off">
                @error('password') <p class="error">{{ $message }}</p> @enderror
            </div>
            <div class="form-submit">
                <button type="submit" class="btn-submit">ログイン</button>
            </div>
        </form>
    </div>
@endsection