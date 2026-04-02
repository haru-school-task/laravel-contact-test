<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    /**
     * 1対多の「1」側：お問い合わせとのリレーション
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class, 'category_id');
    }
}
