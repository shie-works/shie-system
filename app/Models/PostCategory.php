<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'order',
    ];

    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
