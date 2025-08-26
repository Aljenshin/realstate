<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PropertyApiController;
use App\Http\Controllers\Api\SearchApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\NotificationApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API endpoints
Route::prefix('v1')->group(function () {
    
    // Properties API
    Route::get('/properties', [PropertyApiController::class, 'index']);
    Route::get('/properties/{property:slug}', [PropertyApiController::class, 'show']);
    Route::get('/properties/featured', [PropertyApiController::class, 'featured']);
    Route::get('/properties/nearby', [PropertyApiController::class, 'nearby']);
    
    // Search API
    Route::get('/search', [SearchApiController::class, 'search']);
    Route::get('/search/autocomplete', [SearchApiController::class, 'autocomplete']);
    Route::get('/search/filters', [SearchApiController::class, 'filters']);
    Route::get('/search/trending', [SearchApiController::class, 'trending']);
    
    // User registration and login
    Route::post('/auth/register', [UserApiController::class, 'register']);
    Route::post('/auth/login', [UserApiController::class, 'login']);
    Route::post('/auth/forgot-password', [UserApiController::class, 'forgotPassword']);
    
    // Protected routes (require authentication)
    Route::middleware('auth:sanctum')->group(function () {
        
        // User profile
        Route::get('/user/profile', [UserApiController::class, 'profile']);
        Route::put('/user/profile', [UserApiController::class, 'updateProfile']);
        Route::post('/user/avatar', [UserApiController::class, 'uploadAvatar']);
        
        // User properties
        Route::get('/user/properties', [PropertyApiController::class, 'userProperties']);
        Route::post('/properties', [PropertyApiController::class, 'store']);
        Route::put('/properties/{property}', [PropertyApiController::class, 'update']);
        Route::delete('/properties/{property}', [PropertyApiController::class, 'destroy']);
        
        // Favorites
        Route::get('/user/favorites', [PropertyApiController::class, 'favorites']);
        Route::post('/properties/{property}/favorite', [PropertyApiController::class, 'toggleFavorite']);
        
        // Comments and reactions
        Route::get('/properties/{property}/comments', [PropertyApiController::class, 'comments']);
        Route::post('/properties/{property}/comments', [PropertyApiController::class, 'addComment']);
        Route::put('/comments/{comment}', [PropertyApiController::class, 'updateComment']);
        Route::delete('/comments/{comment}', [PropertyApiController::class, 'deleteComment']);
        
        Route::post('/properties/{property}/reactions', [PropertyApiController::class, 'addReaction']);
        Route::delete('/properties/{property}/reactions', [PropertyApiController::class, 'removeReaction']);
        
        // Ratings and reviews
        Route::get('/properties/{property}/ratings', [PropertyApiController::class, 'ratings']);
        Route::post('/properties/{property}/ratings', [PropertyApiController::class, 'addRating']);
        Route::put('/properties/{property}/ratings', [PropertyApiController::class, 'updateRating']);
        
        // Notifications
        Route::get('/notifications', [NotificationApiController::class, 'index']);
        Route::get('/notifications/unread', [NotificationApiController::class, 'unread']);
        Route::put('/notifications/{notification}/read', [NotificationApiController::class, 'markAsRead']);
        Route::put('/notifications/read-all', [NotificationApiController::class, 'markAllAsRead']);
        
        // Property inquiries
        Route::post('/properties/{property}/inquiry', [PropertyApiController::class, 'sendInquiry']);
        Route::get('/user/inquiries', [PropertyApiController::class, 'userInquiries']);
        
        // Logout
        Route::post('/auth/logout', [UserApiController::class, 'logout']);
    });
    
    // Admin routes (require admin role)
    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::get('/admin/dashboard', [UserApiController::class, 'adminDashboard']);
        Route::put('/properties/{property}/feature', [PropertyApiController::class, 'toggleFeatured']);
        Route::get('/admin/analytics', [SearchApiController::class, 'adminAnalytics']);
    });
});

// Webhook endpoints for external services
Route::post('/webhooks/payment', [PropertyApiController::class, 'paymentWebhook']);
Route::post('/webhooks/sms', [NotificationApiController::class, 'smsWebhook']);
