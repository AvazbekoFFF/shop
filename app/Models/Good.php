<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Good extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'prices',
        'description',
        'is_published',
    ];
    protected $casts = [
        'prices' => 'array',
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }
    public function characteristics(): HasMany
    {
        return $this->hasMany(Characteristic::class);
    }
}
