<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // 保存を許可するカラム一覧
    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    /**
     * 1対多の「多」側：カテゴリーとのリレーション
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
