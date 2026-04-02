@extends('layouts.auth')

@section('header-link')
    <a href="/login" class="header-btn">login</a>
@endsection

@section('content')
    <div class="auth-card">
        <h2 class="auth-title">Register</h2>
        <form action="/register" method="POST" class="auth-form" novalidate>
            @csrf
            <div class="form-group">
                <label>お名前</label>
                <input type="text" name="name" placeholder="例: 山田 太郎" value="{{ old('name') }}">
                @error('name') <p class="error">{{ $message }}</p> @enderror
            </div>
            <div class="form-group">
                <label>メールアドレス</label>
                <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                @error('email') <p class="error">{{ $message }}</p> @enderror
            </div>
            <div class="form-group">
                <label>パスワード</label>
                <input type="password" name="password" placeholder="例: coachtech1106">
                @error('password') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label>パスワード確認</label>
                <input type="password" name="password_confirmation"> <!-- ここがセット！ -->
            </div>

            <div class="form-submit">
                <button type="submit" class="btn-submit">登録</button>
            </div>
        </form>
    </div>
@endsection