<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'content' => ['required', 'string', 'max:1000'],
            'parent_id' => ['nullable', 'exists:comments,id'],
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'property_id' => $validated['property_id'],
            'content' => $validated['content'],
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        $comment->load('user');

        return response()->json([
            'success' => true,
            'comment' => $comment,
            'message' => 'Comment added successfully!'
        ]);
    }

    public function update(Request $request, Comment $comment): JsonResponse
    {
        // Check if user owns the comment
        if ($comment->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        $validated = $request->validate([
            'content' => ['required', 'string', 'max:1000'],
        ]);

        $comment->update([
            'content' => $validated['content'],
        ]);

        return response()->json([
            'success' => true,
            'comment' => $comment->fresh(),
            'message' => 'Comment updated successfully!'
        ]);
    }

    public function destroy(Comment $comment): JsonResponse
    {
        // Check if user owns the comment or is admin
        if ($comment->user_id !== Auth::id() && !Auth::user()->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment deleted successfully!'
        ]);
    }

    public function getPropertyComments(Property $property): JsonResponse
    {
        $comments = $property->comments()
            ->with(['user', 'replies.user'])
            ->whereNull('parent_id')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'comments' => $comments
        ]);
    }

    public function reply(Request $request, Comment $parentComment): JsonResponse
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:1000'],
        ]);

        $reply = Comment::create([
            'user_id' => Auth::id(),
            'property_id' => $parentComment->property_id,
            'content' => $validated['content'],
            'parent_id' => $parentComment->id,
        ]);

        $reply->load('user');

        return response()->json([
            'success' => true,
            'reply' => $reply,
            'message' => 'Reply added successfully!'
        ]);
    }
}
