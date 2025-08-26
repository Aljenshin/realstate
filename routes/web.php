<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', HomeController::class);

// Public routes
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property:slug}', [PropertyController::class, 'show'])->name('properties.show');

// Search routes (SOE)
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/search/autocomplete', [SearchController::class, 'autocomplete'])->name('search.autocomplete');
Route::get('/search/filters', [SearchController::class, 'filters'])->name('search.filters');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Properties management
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');
    Route::get('/my-properties', [PropertyController::class, 'myProperties'])->name('properties.my-properties');
    Route::post('/properties/{property}/toggle-featured', [PropertyController::class, 'toggleFeatured'])->name('properties.toggle-featured');

    // Comments system
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/comments/{comment}/reply', [CommentController::class, 'reply'])->name('comments.reply');

    // Reactions system
    Route::post('/reactions/toggle', [ReactionController::class, 'toggle'])->name('reactions.toggle');
    Route::get('/reactions/user', [ReactionController::class, 'getUserReactions'])->name('reactions.user');

    // Search analytics (admin only)
    Route::get('/search/analytics', [SearchController::class, 'analytics'])->name('search.analytics');
});

// API routes for AJAX calls
Route::prefix('api')->group(function () {
    Route::get('/properties/{property}/comments', [CommentController::class, 'getPropertyComments'])->name('api.comments.property');
    Route::get('/properties/{property}/reactions', [ReactionController::class, 'getPropertyReactions'])->name('api.reactions.property');
    Route::get('/properties/{property}/reaction-counts', [ReactionController::class, 'getReactionCounts'])->name('api.reactions.counts');
});

require __DIR__.'/auth.php';
