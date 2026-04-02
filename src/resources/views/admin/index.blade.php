@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
    <div class="admin-header">
        <h1 class="logo">FashionablyLate</h1>

        {{-- ここが重要：Adminタイトル --}}
        <h2 class="admin-title">Admin</h2>

        {{-- ここが重要：ログアウトボタン --}}
        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">logout</button>
            </form>
        </div>
    </div>

    {{-- 2. 検索エリア：横並びを意識したクラス構成 --}}
    <div class="search-section">
        <form action="{{ route('admin.index') }}" method="GET" class="search-form">
            <input type="text" name="first_last_name" placeholder="名前やメールアドレスを入力してください"
                value="{{ request('first_last_name') }}">

            <select name="gender">
                <!-- 1. デフォルト表示：検索前、または「性別」に戻したい時用 -->
                <option value="" {{ request('gender') === null ? 'selected' : '' }}>性別</option>

                <!-- 2. 「全て」：ユーザーが明示的に全件検索したい時用 -->
                <option value="0" {{ request('gender') === '0' ? 'selected' : '' }}>全て</option>

                <!-- 3. 各性別 -->
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>

            <select name="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>

            {{-- 日付選択 --}}
            <input type="date" name="date" value="{{ request('date') }}" placeholder="年/月/日">

            <button type="submit" class="btn-search">検索</button>
            <a href="{{ route('admin.index') }}" class="btn-reset">リセット</a>
        </form>
    </div>

    {{-- 3. 操作エリア：左にエクスポート、右にページネーション --}}
    <div class="action-section">
        <a href="{{ route('admin.export', request()->all()) }}" class="btn-export">エクスポート</a>

        <div class="pagination-wrapper">
            {{ $contacts->appends(request()->query())->links('pagination::bootstrap-4') }}
            {{-- ※Laravel標準を使う場合は単に $contacts->links() でもOKです --}}
        </div>
    </div>

    {{-- 4. データテーブル --}}
    <table class="admin-table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->last_name }}　{{ $contact->first_name }}</td>
                    <td>
                        @php $genders = ['1' => '男性', '2' => '女性', '3' => 'その他']; @endphp
                        {{ $genders[$contact->gender] ?? '' }}
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content }}</td>
                    <td>
                        {{-- 詳細ボタン --}}
                        <button class="btn-detail" data-id="{{ $contact->id }}"
                            data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                            data-gender="{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}"
                            data-email="{{ $contact->email }}" data-tel="{{ $contact->tel }}"
                            data-address="{{ $contact->address }}" data-building="{{ $contact->building }}"
                            data-category="{{ $contact->category->content }}" data-detail="{{ $contact->detail }}"
                            onclick="openModal(this)">
                            詳細
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    {{-- モーダルのHTML --}}
    @include('admin.partials.modal')

@endsection