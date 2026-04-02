@extends('layouts.user')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/input.css') }}">
@endsection

@section('content')
    <div class="form-container">
        <h1 class="title">FashionablyLate</h1>
        <h2 class="subtitle">Contact</h2>

        <form action="{{ route('inquiry.confirm') }}" method="POST" novalidate>
            @csrf

            <!-- お名前 -->
            <div class="form-row">
                <div class="form-label">お名前<span>※</span></div>
                <div class="form-content">
                    <div class="input-flex">
                        <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                        <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
                    </div>
                    @error('last_name') <p class="error">{{ $message }}</p> @enderror
                    @error('first_name') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- 性別 -->
            <div class="form-row">
                <div class="form-label">性別<span>※</span></div>
                <div class="form-content">
                    <div class="radio-group">
                        <!-- checked を全て外す -->
                        <input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}> 男性
                        <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性
                        <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他
                    </div>
                    @error('gender') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- メールアドレス -->
            <div class="form-row">
                <div class="form-label">メールアドレス<span>※</span></div>
                <div class="form-content">
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                    @error('email') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- 電話番号 -->
            <div class="form-row">
                <div class="form-label">電話番号<span>※</span></div>
                <div class="form-content">
                    <div class="input-flex tel-input">
                        <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}"> -
                        <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}"> -
                        <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
                    </div>
                    @error('tel1') <p class="error">{{ $message }}</p> @enderror
                    @error('tel2') <p class="error">{{ $message }}</p> @enderror
                    @error('tel3') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- 住所 -->
            <div class="form-row">
                <div class="form-label">住所<span>※</span></div>
                <div class="form-content">
                    <input type="text" name="address" placeholder="例: 東京都渋谷区..." value="{{ old('address') }}">
                    @error('address') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- 建物名 -->
            <div class="form-row">
                <div class="form-label">建物名</div>
                <div class="form-content">
                    <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
                </div>
            </div>

            <!-- お問い合わせの種類 -->
            <div class="form-row">
                <div class="form-label">お問い合わせの種類<span>※</span></div>
                <div class="form-content">
                    <select name="category_id">
                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- 内容 -->
            <div class="form-row">
                <div class="form-label">お問い合わせの内容<span>※</span></div>
                <div class="form-content">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                    @error('detail') <p class="error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-submit">
                <button type="submit" class="submit-btn">確認画面へ</button>
            </div>
        </form>
    </div>
@endsection