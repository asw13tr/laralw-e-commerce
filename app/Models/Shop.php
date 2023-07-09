<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shop extends Model{
    use HasFactory;

    protected $table = 'shops';
    protected $primaryKey = 'id';
    protected $guarded = ['created_at', 'updated_at'];

    // RELOTIONSHIP TO COMPANY USER
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    // RELOTIONSHIP TO COMPANY CATEGORY
    public function category(): BelongsTo{
        return $this->belongsTo(CompanyCategory::class);
    }

    // RELOTIONSHIP TO COMPANY COUNTRY
    public function country(): BelongsTo{
        return $this->belongsTo(Country::class);
    }
}
