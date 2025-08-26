<?php

namespace App\Services;

use App\Models\Property;
use App\Models\User;
use App\Models\Reaction;
use App\Models\SearchLog;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PropertyRecommendationService
{
    /**
     * Get personalized property recommendations for a user
     */
    public function getRecommendations(User $user, int $limit = 10): Collection
    {
        $recommendations = collect();
        
        // 1. Based on user's search history
        $searchBasedRecommendations = $this->getSearchBasedRecommendations($user, $limit / 2);
        $recommendations = $recommendations->merge($searchBasedRecommendations);
        
        // 2. Based on user's reactions and interactions
        $interactionBasedRecommendations = $this->getInteractionBasedRecommendations($user, $limit / 2);
        $recommendations = $recommendations->merge($interactionBasedRecommendations);
        
        // 3. Based on similar users (collaborative filtering)
        $collaborativeRecommendations = $this->getCollaborativeRecommendations($user, $limit / 2);
        $recommendations = $recommendations->merge($collaborativeRecommendations);
        
        // 4. Popular and trending properties
        $trendingRecommendations = $this->getTrendingRecommendations($limit / 2);
        $recommendations = $recommendations->merge($trendingRecommendations);
        
        // Remove duplicates and limit results
        return $recommendations->unique('id')->take($limit);
    }
    
    /**
     * Get recommendations based on user's search history
     */
    private function getSearchBasedRecommendations(User $user, int $limit): Collection
    {
        $recentSearches = SearchLog::where('user_id', $user->id)
            ->whereNotNull('search_query')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->pluck('search_query');
            
        if ($recentSearches->isEmpty()) {
            return collect();
        }
        
        return Property::where(function ($query) use ($recentSearches) {
            foreach ($recentSearches as $search) {
                $query->orWhere('title', 'like', "%{$search}%")
                      ->orWhere('location', 'like', "%{$search}%")
                      ->orWhere('search_tags', 'like', "%{$search}%");
            }
        })
        ->active()
        ->with(['images', 'user'])
        ->orderBy('is_featured', 'desc')
        ->orderBy('views_count', 'desc')
        ->take($limit)
        ->get();
    }
    
    /**
     * Get recommendations based on user's interactions
     */
    private function getInteractionBasedRecommendations(User $user, int $limit): Collection
    {
        // Get properties the user has reacted to
        $reactedPropertyIds = Reaction::where('user_id', $user->id)
            ->pluck('property_id');
            
        if ($reactedPropertyIds->isEmpty()) {
            return collect();
        }
        
        // Find similar properties based on type, location, and price range
        $reactedProperties = Property::whereIn('id', $reactedPropertyIds)->get();
        
        $recommendations = collect();
        foreach ($reactedProperties as $property) {
            $similarProperties = Property::where('id', '!=', $property->id)
                ->where('property_type', $property->property_type)
                ->where('location', 'like', "%{$property->location}%")
                ->whereBetween('price', [$property->price * 0.7, $property->price * 1.3])
                ->active()
                ->with(['images', 'user'])
                ->take(2)
                ->get();
                
            $recommendations = $recommendations->merge($similarProperties);
        }
        
        return $recommendations->take($limit);
    }
    
    /**
     * Get collaborative filtering recommendations
     */
    private function getCollaborativeRecommendations(User $user, int $limit): Collection
    {
        // Find users with similar preferences
        $similarUsers = $this->findSimilarUsers($user);
        
        if ($similarUsers->isEmpty()) {
            return collect();
        }
        
        // Get properties liked by similar users
        $similarUserIds = $similarUsers->pluck('id');
        $recommendedPropertyIds = Reaction::whereIn('user_id', $similarUserIds)
            ->where('reaction_type', 'like')
            ->orWhere('reaction_type', 'love')
            ->pluck('property_id');
            
        return Property::whereIn('id', $recommendedPropertyIds)
            ->where('user_id', '!=', $user->id) // Don't recommend user's own properties
            ->active()
            ->with(['images', 'user'])
            ->orderBy('is_featured', 'desc')
            ->take($limit)
            ->get();
    }
    
    /**
     * Find users with similar preferences
     */
    private function findSimilarUsers(User $user): Collection
    {
        // Get user's preferred property types and locations
        $userPreferences = $this->getUserPreferences($user);
        
        if ($userPreferences->isEmpty()) {
            return collect();
        }
        
        // Find users who like similar properties
        $similarUsers = User::where('id', '!=', $user->id)
            ->whereHas('reactions', function ($query) use ($userPreferences) {
                $query->whereHas('property', function ($q) use ($userPreferences) {
                    foreach ($userPreferences as $preference) {
                        $q->where('property_type', $preference['type'])
                          ->where('location', 'like', "%{$preference['location']}%");
                    }
                });
            })
            ->take(10)
            ->get();
            
        return $similarUsers;
    }
    
    /**
     * Get user's property preferences
     */
    private function getUserPreferences(User $user): Collection
    {
        $reactions = Reaction::where('user_id', $user->id)
            ->with('property:id,property_type,location')
            ->get();
            
        $preferences = collect();
        foreach ($reactions as $reaction) {
            $preferences->push([
                'type' => $reaction->property->property_type,
                'location' => $reaction->property->location,
            ]);
        }
        
        return $preferences->unique(function ($item) {
            return $item['type'] . '-' . $item['location'];
        });
    }
    
    /**
     * Get trending properties
     */
    private function getTrendingRecommendations(int $limit): Collection
    {
        return Property::active()
            ->with(['images', 'user'])
            ->orderBy('views_count', 'desc')
            ->orderBy('inquiries_count', 'desc')
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }
    
    /**
     * Get nearby properties based on coordinates
     */
    public function getNearbyProperties(float $latitude, float $longitude, int $radius = 10, int $limit = 20): Collection
    {
        $haversine = "(6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(latitude))))";
        
        return Property::select('*')
            ->selectRaw("$haversine AS distance")
            ->whereRaw("$haversine < ?", [$radius])
            ->active()
            ->with(['images', 'user'])
            ->orderBy('distance')
            ->take($limit)
            ->get();
    }
    
    /**
     * Get property insights and analytics
     */
    public function getPropertyInsights(Property $property): array
    {
        $totalViews = $property->views_count;
        $totalInquiries = $property->inquiries_count;
        $totalReactions = $property->reactions()->count();
        $totalComments = $property->comments()->count();
        
        $reactionBreakdown = $property->reactions()
            ->select('reaction_type', DB::raw('count(*) as count'))
            ->groupBy('reaction_type')
            ->pluck('count', 'reaction_type')
            ->toArray();
            
        $dailyViews = $this->getDailyViews($property);
        
        return [
            'total_views' => $totalViews,
            'total_inquiries' => $totalInquiries,
            'total_reactions' => $totalReactions,
            'total_comments' => $totalComments,
            'reaction_breakdown' => $reactionBreakdown,
            'daily_views' => $dailyViews,
            'engagement_rate' => $totalViews > 0 ? (($totalReactions + $totalComments) / $totalViews) * 100 : 0,
            'inquiry_rate' => $totalViews > 0 ? ($totalInquiries / $totalViews) * 100 : 0,
        ];
    }
    
    /**
     * Get daily views for a property
     */
    private function getDailyViews(Property $property): array
    {
        // This would typically come from a separate analytics table
        // For now, return sample data
        return [
            'today' => rand(5, 25),
            'yesterday' => rand(3, 20),
            'this_week' => rand(20, 100),
            'this_month' => rand(80, 400),
        ];
    }
}
