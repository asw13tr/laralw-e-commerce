<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model{
    use HasFactory;

    protected $table = 'product_categories';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    public function parent(){
        return $this->belongsTo(ProductCategory::class, 'parent', 'id');
    }

    public function children(){
        return $this->hasMany(ProductCategory::class, 'parent', 'id');
    }
}
