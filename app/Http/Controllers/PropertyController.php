<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    public function index(Request $request): View
    {
        $query = Property::with(['images', 'user', 'reactions'])
            ->active();

        // Apply search query
        if ($request->filled('q')) {
            $searchTerm = $request->get('q');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('location', 'like', "%{$searchTerm}%")
                  ->orWhere('search_tags', 'like', "%{$searchTerm}%");
            });
        }

        // Apply property type filter
        if ($request->filled('type')) {
            $query->where('property_type', $request->get('type'));
        }

        // Apply location filter
        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->get('location')}%");
        }

        // Apply price filter
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->get('max_price'));
        }

        // Apply sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'popular':
                $query->orderBy('views_count', 'desc');
                break;
            default:
                $query->latest();
        }

        $properties = $query->paginate(12)->withQueryString();
            
        return view('properties.index', compact('properties'));
    }

    public function show(Property $property): View
    {
        // Increment view count
        $property->incrementViews();
        
        $property->load(['images', 'user', 'comments.user', 'reactions.user']);
        
        return view('properties.show', compact('property'));
    }

    public function create(): View
    {
        return view('properties.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'phone' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'property_type' => ['required', 'in:apartment,house,condo,land,commercial'],
            'bedrooms' => ['nullable', 'integer', 'min:0'],
            'bathrooms' => ['nullable', 'integer', 'min:0'],
            'area' => ['nullable', 'numeric', 'min:0'],
            'amenities' => ['nullable', 'array'],
            'amenities.*' => ['string'],
            'search_tags' => ['nullable', 'string'],
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $property = Property::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'location' => $validated['location'],
            'price' => $validated['price'],
            'phone' => $validated['phone'],
            'description' => $validated['description'],
            'property_type' => $validated['property_type'],
            'bedrooms' => $validated['bedrooms'],
            'bathrooms' => $validated['bathrooms'],
            'area' => $validated['area'],
            'amenities' => $validated['amenities'] ?? [],
            'search_tags' => $validated['search_tags'],
            'slug' => Str::slug($validated['title']),
            'meta_description' => Str::limit($validated['description'], 160),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('property-images', 'public');
                
                // Set first image as featured
                $isFeatured = $index === 0;
                
                PropertyImage::create([
                    'property_id' => $property->id,
                    'path' => $path,
                    'position' => $index,
                ]);
                
                if ($isFeatured) {
                    $property->update(['featured_image' => $path]);
                }
            }
        }

        return redirect()->route('properties.show', $property)
            ->with('status', 'Property listed successfully!');
    }

    public function edit(Property $property): View
    {
        // Check if user owns the property
        if ($property->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property): RedirectResponse
    {
        // Check if user owns the property
        if ($property->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'phone' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'property_type' => ['required', 'in:apartment,house,condo,land,commercial'],
            'bedrooms' => ['nullable', 'integer', 'min:0'],
            'bathrooms' => ['nullable', 'integer', 'min:0'],
            'area' => ['nullable', 'numeric', 'min:0'],
            'amenities' => ['nullable', 'array'],
            'amenities.*' => ['string'],
            'search_tags' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive,sold'],
        ]);

        $property->update([
            'title' => $validated['title'],
            'location' => $validated['location'],
            'price' => $validated['price'],
            'phone' => $validated['phone'],
            'description' => $validated['description'],
            'property_type' => $validated['property_type'],
            'bedrooms' => $validated['bedrooms'],
            'bathrooms' => $validated['bathrooms'],
            'area' => $validated['area'],
            'amenities' => $validated['amenities'] ?? [],
            'search_tags' => $validated['search_tags'],
            'status' => $validated['status'],
            'slug' => Str::slug($validated['title']),
            'meta_description' => Str::limit($validated['description'], 160),
        ]);

        return redirect()->route('properties.show', $property)
            ->with('status', 'Property updated successfully!');
    }

    public function destroy(Property $property): RedirectResponse
    {
        // Check if user owns the property
        if ($property->user_id !== Auth::id()) {
            abort(403);
        }

        // Delete associated images from storage
        foreach ($property->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $property->delete();

        return redirect()->route('properties.index')
            ->with('status', 'Property deleted successfully!');
    }

    public function myProperties(): View
    {
        $properties = Property::where('user_id', Auth::id())
            ->with(['images', 'reactions'])
            ->latest()
            ->paginate(12);
            
        return view('properties.my-properties', compact('properties'));
    }

    public function toggleFeatured(Property $property): JsonResponse
    {
        // Check if user owns the property
        if ($property->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $property->update(['is_featured' => !$property->is_featured]);

        return response()->json([
            'success' => true,
            'is_featured' => $property->is_featured,
            'message' => $property->is_featured ? 'Property marked as featured!' : 'Property unfeatured!'
        ]);
    }
}


