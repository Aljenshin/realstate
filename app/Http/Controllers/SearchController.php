<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\SearchLog;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $query = $request->get('q', '');
        $filters = $this->getFilters($request);
        
        $properties = $this->performSearch($query, $filters);
        
        // Log the search for analytics
        $this->logSearch($query, $filters, $properties->count());
        
        // Get popular search terms for suggestions
        $popularSearches = SearchLog::popularQueries(10)->get();
        
        return view('search.index', compact('properties', 'query', 'filters', 'popularSearches'));
    }

    public function autocomplete(Request $request): JsonResponse
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $suggestions = Property::where('title', 'like', "%{$query}%")
            ->orWhere('location', 'like', "%{$query}%")
            ->orWhere('search_tags', 'like', "%{$query}%")
            ->select('title', 'location', 'property_type')
            ->distinct()
            ->limit(10)
            ->get()
            ->map(function ($property) {
                return [
                    'text' => $property->title,
                    'location' => $property->location,
                    'type' => $property->property_type,
                ];
            });

        return response()->json($suggestions);
    }

    public function filters(Request $request): JsonResponse
    {
        $filters = $this->getFilters($request);
        
        // Get available filter options based on current data
        $filterOptions = [
            'property_types' => Property::distinct()->pluck('property_type'),
            'locations' => Property::distinct()->pluck('location')->filter(),
            'bedroom_options' => [1, 2, 3, 4, 5, '5+'],
            'price_ranges' => [
                ['min' => 0, 'max' => 500000, 'label' => 'Under ₱500K'],
                ['min' => 500000, 'max' => 1000000, 'label' => '₱500K - ₱1M'],
                ['min' => 1000000, 'max' => 2000000, 'label' => '₱1M - ₱2M'],
                ['min' => 2000000, 'max' => 5000000, 'label' => '₱2M - ₱5M'],
                ['min' => 5000000, 'max' => null, 'label' => 'Over ₱5M'],
            ],
        ];

        return response()->json($filterOptions);
    }

    public function analytics(): View
    {
        $recentSearches = SearchLog::recent(7)->with('user')->latest()->paginate(20);
        $popularQueries = SearchLog::popularQueries(20)->get();
        $searchTrends = $this->getSearchTrends();
        
        return view('search.analytics', compact('recentSearches', 'popularQueries', 'searchTrends'));
    }

    private function performSearch(string $query, array $filters)
    {
        $properties = Property::with(['images', 'user', 'reactions', 'comments'])
            ->active();

        // Apply search query
        if (!empty($query)) {
            $properties->search($query);
        }

        // Apply filters
        if (!empty($filters['property_type'])) {
            $properties->byType($filters['property_type']);
        }

        if (!empty($filters['location'])) {
            $properties->byLocation($filters['location']);
        }

        if (!empty($filters['min_price']) || !empty($filters['max_price'])) {
            $minPrice = $filters['min_price'] ?? 0;
            $maxPrice = $filters['max_price'] ?? 999999999;
            $properties->byPriceRange($minPrice, $maxPrice);
        }

        if (!empty($filters['bedrooms'])) {
            $properties->byBedrooms($filters['bedrooms']);
        }

        if (!empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'price_low':
                    $properties->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $properties->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $properties->latest();
                    break;
                case 'oldest':
                    $properties->oldest();
                    break;
                case 'popular':
                    $properties->orderBy('views_count', 'desc');
                    break;
                default:
                    $properties->latest();
            }
        } else {
            $properties->latest();
        }

        return $properties->paginate(12)->withQueryString();
    }

    private function getFilters(Request $request): array
    {
        return [
            'property_type' => $request->get('type'),
            'location' => $request->get('location'),
            'min_price' => $request->get('min_price'),
            'max_price' => $request->get('max_price'),
            'bedrooms' => $request->get('bedrooms'),
            'sort' => $request->get('sort', 'newest'),
        ];
    }

    private function logSearch(string $query, array $filters, int $resultsCount): void
    {
        SearchLog::create([
            'search_query' => $query ?: null,
            'filters' => $filters,
            'results_count' => $resultsCount,
            'user_id' => Auth::id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'session_id' => request()->session()->getId(),
        ]);
    }

    private function getSearchTrends(): array
    {
        $trends = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $count = SearchLog::whereDate('created_at', $date)->count();
            $trends[] = [
                'date' => $date->format('M d'),
                'count' => $count,
            ];
        }
        
        return $trends;
    }
}
