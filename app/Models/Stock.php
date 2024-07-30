<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'good_id',
        'count',
        'address',
    ];
    protected $hidden = [
        'good_id',
        'created_at',
        'updated_at',
    ];

    public function good(): BelongsTo
    {
        return $this->belongsTo(Good::class);
    }
}
