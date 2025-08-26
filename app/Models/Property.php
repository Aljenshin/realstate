<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'location',
        'price',
        'phone',
        'description',
        'status',
        'property_type',
        'bedrooms',
        'bathrooms',
        'area',
        'amenities',
        'search_tags',
        'slug',
        'meta_description',
        'featured_image',
        'is_featured',
        'views_count',
        'inquiries_count',
    ];

    protected $casts = [
        'amenities' => 'array',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
        'area' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class)->orderBy('position');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->approved()->with('user', 'replies.user');
    }

    public function reactions(): HasMany
    {
        return $this->hasMany(Reaction::class);
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', 'active');
    }

    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    public function scopeByType(Builder $query, string $type): void
    {
        $query->where('property_type', $type);
    }

    public function scopeByLocation(Builder $query, string $location): void
    {
        $query->where('location', 'like', "%{$location}%");
    }

    public function scopeByPriceRange(Builder $query, float $min, float $max): void
    {
        $query->whereBetween('price', [$min, $max]);
    }

    public function scopeByBedrooms(Builder $query, int $bedrooms): void
    {
        $query->where('bedrooms', '>=', $bedrooms);
    }

    public function scopeSearch(Builder $query, string $search): void
    {
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('location', 'like', "%{$search}%")
              ->orWhere('search_tags', 'like', "%{$search}%");
        });
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    public function incrementInquiries(): void
    {
        $this->increment('inquiries_count');
    }

    public function getReactionCount(string $type): int
    {
        return $this->reactions()->byType($type)->count();
    }

    public function getUserReaction(int $userId): ?Reaction
    {
        return $this->reactions()->byUser($userId)->first();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            if (empty($property->slug)) {
                $property->slug = \Str::slug($property->title);
            }
        });

        // Auto-set featured image from first PropertyImage if not set
        static::saved(function ($property) {
            if (empty($property->featured_image) && $property->images()->count() > 0) {
                $property->update(['featured_image' => $property->images()->first()->path]);
            }
        });
    }

    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            if (Storage::disk('public')->exists($this->featured_image)) {
                return Storage::disk('public')->url($this->featured_image);
            }
        }
        
        if ($this->images()->count() > 0) {
            $firstPath = $this->images()->first()->path;
            if (Storage::disk('public')->exists($firstPath)) {
                return Storage::disk('public')->url($firstPath);
            }
        }
        
        // Remote photo fallbacks by property type (stable Unsplash images)
        $type = strtolower((string) $this->property_type);
        $fallbacks = [
            'apartment' => 'https://images.unsplash.com/photo-1501183638710-841dd1904471?q=80&w=1600&auto=format&fit=crop',
            'condo' => 'https://images.unsplash.com/photo-1500048993953-d23a436266cf?q=80&w=1600&auto=format&fit=crop',
            'house' => 'https://images.unsplash.com/photo-1600585154515-011c3b81a6ff?q=80&w=1600&auto=format&fit=crop',
            'land' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1600&auto=format&fit=crop',
            'commercial' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1600&auto=format&fit=crop',
        ];
        if (isset($fallbacks[$type])) {
            return $fallbacks[$type];
        }
        
        // Generic nice interior fallback
        return 'https://images.unsplash.com/photo-1560185127-6ed189bf02f4?q=80&w=1600&auto=format&fit=crop';
    }
}



