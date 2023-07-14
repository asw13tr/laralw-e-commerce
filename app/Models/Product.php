<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    public function categories(): BelongsToMany{
        return $this->belongsToMany(ProductCategory::class, 'product_category', 'product_id', 'category_id');
    }

    public function shop(): BelongsTo{
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }



}
