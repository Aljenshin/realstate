<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SearchLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'search_query',
        'filters',
        'results_count',
        'user_id',
        'ip_address',
        'user_agent',
        'session_id',
    ];

    protected $casts = [
        'filters' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function scopePopularQueries($query, $limit = 10)
    {
        return $query->selectRaw('search_query, COUNT(*) as count')
            ->whereNotNull('search_query')
            ->groupBy('search_query')
            ->orderBy('count', 'desc')
            ->limit($limit);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
