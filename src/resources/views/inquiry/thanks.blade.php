@extends('layouts.user')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
    <div class="thanks-container">
        <!-- 背景の大きな文字 -->
        <div class="thanks-background-text">Thank you</div>

        <!-- 手前のメインコンテンツ -->
        <div class="thanks-content">
            <p class="thanks-message">お問い合わせありがとうございました</p>

            <a href="/" class="home-btn">HOME</a>
        </div>
    </div>
@endsection