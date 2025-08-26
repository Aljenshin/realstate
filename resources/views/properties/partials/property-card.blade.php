<div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200 {{ isset($featured) && $featured ? 'ring-2 ring-yellow-400' : '' }}">
    <!-- Property Image -->
    <div class="relative">
        @php
            $placeholder = 'data:image/svg+xml;utf8,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600"><defs><linearGradient id="g" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#dbeafe"/><stop offset="100%" stop-color="#ede9fe"/></linearGradient></defs><rect width="100%" height="100%" fill="url(#g)"/><g fill="#6b7280" font-family="sans-serif" text-anchor="middle"><text x="50%" y="45%" font-size="28" font-weight="700">No Image</text><text x="50%" y="55%" font-size="16">Property</text></g></svg>');
            $imgSrc = $property->featured_image_url ?: $placeholder;
        @endphp
        <img src="{{ $imgSrc }}"
             onerror="this.onerror=null; this.src='{{ $placeholder }}'"
             class="w-full h-48 object-cover"
             alt="{{ $property->title }}">
        
        <!-- Featured Badge -->
        @if($property->is_featured)
            <div class="absolute top-2 left-2 bg-yellow-400 text-yellow-900 px-2 py-1 rounded-full text-xs font-semibold">
                ⭐ Featured
            </div>
        @endif
        
        <!-- Property Type Badge -->
        <div class="absolute top-2 right-2 bg-blue-600 text-white px-2 py-1 rounded-full text-xs font-semibold capitalize">
                            {{ $property->property_type }}
        </div>
        
        <!-- Image Count Badge -->
        @if($property->images->count() > 1)
            <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white px-2 py-1 rounded text-xs">
                📸 {{ $property->images->count() }} photos
            </div>
        @endif
    </div>

    <!-- Property Details -->
    <div class="p-4">
        <!-- Title and Price -->
        <div class="mb-3">
            <h3 class="font-semibold text-gray-900 text-lg mb-1 line-clamp-2">
                <a href="{{ route('properties.show', $property) }}" class="hover:text-blue-600 transition">
                    {{ $property->title }}
                </a>
            </h3>
            <div class="text-2xl font-bold text-blue-600">
                ₱{{ number_format($property->price ?? 0, 0) }}
            </div>
        </div>

        <!-- Location -->
        <div class="flex items-center text-gray-600 mb-3">
            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span class="text-sm">{{ $property->location }}</span>
        </div>

        <!-- Property Specs -->
        <div class="grid grid-cols-3 gap-2 mb-4">
            @if($property->bedrooms)
            <div class="text-center p-2 bg-gray-50 rounded">
                <div class="text-lg font-semibold text-gray-900">{{ $property->bedrooms }}</div>
                <div class="text-xs text-gray-600">Bedrooms</div>
            </div>
            @endif
            
            @if($property->bathrooms)
            <div class="text-center p-2 bg-gray-50 rounded">
                <div class="text-lg font-semibold text-gray-900">{{ $property->bathrooms }}</div>
                <div class="text-xs text-gray-600">Bathrooms</div>
            </div>
            @endif
            
            @if($property->area)
            <div class="text-center p-2 bg-gray-50 rounded">
                <div class="text-lg font-semibold text-gray-900">{{ $property->area }}</div>
                <div class="text-xs text-gray-600">sqm</div>
            </div>
            @endif
        </div>

        <!-- Amenities Preview -->
        @if($property->amenities && count($property->amenities) > 0)
        <div class="mb-4">
            <div class="flex flex-wrap gap-1">
                @foreach(array_slice($property->amenities, 0, 3) as $amenity)
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                        {{ $amenity }}
                    </span>
                @endforeach
                @if(count($property->amenities) > 3)
                    <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">
                        +{{ count($property->amenities) - 3 }} more
                    </span>
                @endif
            </div>
        </div>
        @endif

        <!-- Description Preview -->
        @if($property->description)
        <div class="mb-4">
            <p class="text-gray-600 text-sm line-clamp-2">
                {{ $property->description }}
            </p>
        </div>
        @endif

        <!-- Contact Info -->
        @if($property->phone)
        <div class="flex items-center text-gray-600 mb-4">
            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
            </svg>
            <span class="text-sm">{{ $property->phone }}</span>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex space-x-2">
            <a href="{{ route('properties.show', $property) }}" 
               class="flex-1 bg-blue-600 text-white text-center py-2 px-4 rounded-md hover:bg-blue-700 transition text-sm font-medium">
                View Details
            </a>
            
            @auth
            <button onclick="toggleReaction({{ $property->id }}, 'interested')" 
                    class="px-3 py-2 border border-gray-300 rounded-md hover:bg-gray-50 transition text-sm">
                💬 Inquire
            </button>
            @endauth
        </div>

        <!-- Stats -->
        <div class="flex justify-between items-center mt-3 pt-3 border-t border-gray-100 text-xs text-gray-500">
            <span>👁️ {{ $property->views_count }} views</span>
            <span>📅 {{ $property->created_at->diffForHumans() }}</span>
        </div>
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<script>
function toggleReaction(propertyId, reactionType) {
    // This will be implemented with the reaction system
    console.log('Toggle reaction:', propertyId, reactionType);
}
</script>
