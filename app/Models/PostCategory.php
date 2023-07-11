<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostCategory extends Model
{
    use HasFactory;

    protected $table = 'post_categories';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function posts(): BelongsToMany{
        return $this->belongsToMany(Post::class, 'post_category', 'category_id', 'post_id');
    }

}
