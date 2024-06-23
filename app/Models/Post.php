<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'post_category_id',
        'title',
        'description',
        'main_image',
    ];

    public function postCategory()
    {
        return $this->belongsTo(PostCategory::class);
    }

    public function postDetail()
    {
        return $this->hasMany(PostDetail::class);
    }
}
