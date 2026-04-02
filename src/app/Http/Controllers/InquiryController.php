<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest; // 作成したFormRequestをインポート
use App\Models\Contact; // 保存用モデル
use App\Models\Category; // カテゴリー取得用モデル
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::all();
        return view('inquiry.input', compact('categories'));
    }

    // PG02: 確認画面を表示
    // 引数を Request から ContactRequest に変えるだけでバリデーションが自動実行されます
    public function confirm(ContactRequest $request)
    {
        // バリデーション済みのデータを取得
        $inputs = $request->all();

        // category_id を元に、DBからカテゴリー情報を取得
        $category = \App\Models\Category::find($request->category_id);

        // カテゴリー名を $inputs に追加してViewに渡す（または単独で渡す）
        $category_content = $category ? $category->content : '';

        return view('inquiry.confirm', compact('inputs', 'category_content'));
    }

    // PG03: DB保存処理とサンクスページ表示
    public function store(Request $request)
    {
        // 1. 確認画面から送られてきた「hidden」の値をすべて取得
        $contact_data = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'building',
            'category_id',
            'detail'
        ]);

        // 2. 電話番号を1つに結合（仕様書の tel カラムに合わせる）
        $tel = $contact_data['tel1'] . $contact_data['tel2'] . $contact_data['tel3'];

        // 3. Contactモデルを使ってDBに保存
        \App\Models\Contact::create([
            'last_name' => $contact_data['last_name'],
            'first_name' => $contact_data['first_name'],
            'gender' => $contact_data['gender'],
            'email' => $contact_data['email'],
            'tel' => $tel,
            'address' => $contact_data['address'],
            'building' => $contact_data['building'],
            'category_id' => $contact_data['category_id'], // ここ重要！
            'detail' => $contact_data['detail'],
        ]);

        return view('inquiry.thanks');
    }
}
