<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ReactionController extends Controller
{
    public function toggle(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'reaction_type' => ['required', 'in:like,love,wow,helpful,interested'],
        ]);

        $userId = Auth::id();
        $propertyId = $validated['property_id'];
        $reactionType = $validated['reaction_type'];

        // Check if user already has a reaction on this property
        $existingReaction = Reaction::where('user_id', $userId)
            ->where('property_id', $propertyId)
            ->first();

        if ($existingReaction) {
            if ($existingReaction->reaction_type === $reactionType) {
                // Remove reaction if same type
                $existingReaction->delete();
                
                return response()->json([
                    'success' => true,
                    'action' => 'removed',
                    'reaction_type' => null,
                    'message' => 'Reaction removed!'
                ]);
            } else {
                // Update reaction type
                $existingReaction->update(['reaction_type' => $reactionType]);
                
                return response()->json([
                    'success' => true,
                    'action' => 'updated',
                    'reaction_type' => $reactionType,
                    'message' => 'Reaction updated!'
                ]);
            }
        } else {
            // Create new reaction
            Reaction::create([
                'user_id' => $userId,
                'property_id' => $propertyId,
                'reaction_type' => $reactionType,
            ]);
            
            return response()->json([
                'success' => true,
                'action' => 'added',
                'reaction_type' => $reactionType,
                'message' => 'Reaction added!'
            ]);
        }
    }

    public function getPropertyReactions(Property $property): JsonResponse
    {
        $reactions = $property->reactions()
            ->with('user')
            ->get()
            ->groupBy('reaction_type')
            ->map(function ($reactions) {
                return [
                    'count' => $reactions->count(),
                    'users' => $reactions->take(5)->pluck('user.name'),
                ];
            });

        // Get current user's reaction
        $userReaction = null;
        if (Auth::check()) {
            $userReaction = $property->getUserReaction(Auth::id());
        }

        return response()->json([
            'success' => true,
            'reactions' => $reactions,
            'user_reaction' => $userReaction ? $userReaction->reaction_type : null,
        ]);
    }

    public function getReactionCounts(Property $property): JsonResponse
    {
        $counts = [
            'like' => $property->getReactionCount('like'),
            'love' => $property->getReactionCount('love'),
            'wow' => $property->getReactionCount('wow'),
            'helpful' => $property->getReactionCount('helpful'),
            'interested' => $property->getReactionCount('interested'),
        ];

        return response()->json([
            'success' => true,
            'counts' => $counts,
        ]);
    }

    public function getUserReactions(Request $request): JsonResponse
    {
        $userId = Auth::id();
        
        $reactions = Reaction::where('user_id', $userId)
            ->with(['property.images'])
            ->latest()
            ->paginate(20);

        return response()->json([
            'success' => true,
            'reactions' => $reactions,
        ]);
    }
}
