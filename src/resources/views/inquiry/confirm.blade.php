@extends('layouts.user')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
    <div class="form-container">
        <h1 class="title">FashionablyLate</h1>
        <h2 class="subtitle">Confirm</h2>

        <form action="{{ route('inquiry.store') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-label">お名前</div>
                <div class="form-content">
                    {{ $inputs['last_name'] }}　{{ $inputs['first_name'] }}
                    <input type="hidden" name="last_name" value="{{ $inputs['last_name'] }}">
                    <input type="hidden" name="first_name" value="{{ $inputs['first_name'] }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-label">性別</div>
                <div class="form-content">
                    @php $genders = ['1' => '男性', '2' => '女性', '3' => 'その他']; @endphp
                    {{ $genders[$inputs['gender']] }}
                    <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-label">メールアドレス</div>
                <div class="form-content">
                    {{ $inputs['email'] }}
                    <input type="hidden" name="email" value="{{ $inputs['email'] }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-label">電話番号</div>
                <div class="form-content">
                    {{ $inputs['tel1'] }}{{ $inputs['tel2'] }}{{ $inputs['tel3'] }}
                    <input type="hidden" name="tel1" value="{{ $inputs['tel1'] }}">
                    <input type="hidden" name="tel2" value="{{ $inputs['tel2'] }}">
                    <input type="hidden" name="tel3" value="{{ $inputs['tel3'] }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-label">住所</div>
                <div class="form-content">
                    {{ $inputs['address'] }}
                    <input type="hidden" name="address" value="{{ $inputs['address'] }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-label">建物名</div>
                <div class="form-content">
                    {{ $inputs['building'] ?? '' }}
                    <input type="hidden" name="building" value="{{ $inputs['building'] }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-label">お問い合わせの種類</div>
                <div class="form-content">
                    {{-- DBから取得した名称を表示 --}}
                    {{ $category_content }}
                    <input type="hidden" name="category_id" value="{{ $inputs['category_id'] }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-label">お問い合わせの内容</div>
                <div class="form-content">
                    {!! nl2br(e($inputs['detail'])) !!}
                    <input type="hidden" name="detail" value="{{ $inputs['detail'] }}">
                </div>
            </div>

            <div class="form-submit confirm-btns">
                <button type="submit" class="submit-btn">送信</button>
                <button type="button" class="back-link" onclick="history.back()">修正</button>
            </div>
        </form>
    </div>
@endsection