<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipment extends Model
{
    protected $table = 'equipment';

    public const CATEGORIES = ['Paddles', 'Balls', 'Nets', 'Accessories'];
    public const STATUSES = ['available' => 'Available', 'unavailable' => 'Unavailable'];

    protected $fillable = [
        'user_id', 'equipment_name', 'category',
        'unit_price', 'description', 'availability_status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        return $query
            ->when($filters['category'] ?? null, fn ($q, $v) => $q->where('category', $v))
            ->when($filters['availability_status'] ?? null, fn ($q, $v) => $q->where('availability_status', $v));
    }
}