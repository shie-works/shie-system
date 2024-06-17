<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'sub_title',
        'text',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
