<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model{
    use HasFactory;

    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function parent(): BelongsTo{
        return $this->belongsTo(Post::class, 'parent');
    }

    public function children(): HasMany{
        return $this->hasMany(Post::class, 'parent');
    }

    public function author(): BelongsTo{
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

}
