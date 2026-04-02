<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Http\Requests\RegisterRequest; // 1. 作成したRequestクラスをインポート
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    public function create(array $input): User
    {
        // 2. RegisterRequestをインスタンス化
        $request = new RegisterRequest();

        // 3. Requestクラスに定義した rules() と messages() を適用
        Validator::make(
            $input,
            $request->rules(),    // RegisterRequestのルールを使用
            $request->messages()  // RegisterRequestの日本語メッセージを使用
        )->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
