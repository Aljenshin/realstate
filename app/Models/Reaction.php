<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'reaction_type',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function scopeForProperty($query, $propertyId)
    {
        return $query->where('property_id', $propertyId);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('reaction_type', $type);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
