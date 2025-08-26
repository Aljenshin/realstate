<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $property->title }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('properties.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md text-sm hover:bg-gray-700 transition">
                    ← Back to Marketplace
                </a>
                @auth
                    @if($property->user_id === Auth::id())
                        <a href="{{ route('properties.edit', $property) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700 transition">
                            Edit Property
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Property Images Gallery -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    @if($property->images->count() > 0)
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Main Image -->
                            <div class="lg:col-span-2">
                                <img src="{{ Storage::disk('public')->url($property->featured_image ?? $property->images->first()->path) }}" 
                                     class="w-full h-96 object-cover rounded-lg" 
                                     alt="{{ $property->title }}">
                            </div>
                            
                            <!-- Thumbnail Images -->
                            @foreach($property->images->take(4) as $image)
                                <div class="lg:col-span-1">
                                    <img src="{{ Storage::disk('public')->url($image->path) }}" 
                                         class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-80 transition" 
                                         alt="{{ $property->title }}"
                                         onclick="setMainImage('{{ Storage::disk('public')->url($image->path) }}')">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="w-full h-96 bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center rounded-lg">
                            <div class="text-center">
                                <div class="text-6xl text-gray-400 mb-4">🏠</div>
                                <div class="text-lg text-gray-600">No Images Available</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Property Details -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h1 class="text-3xl font-bold text-gray-900">{{ $property->title }}</h1>
                                @if($property->is_featured)
                                    <span class="bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">
                                        ⭐ Featured Property
                                    </span>
                                @endif
                            </div>
                            
                            <div class="text-3xl font-bold text-blue-600 mb-4">
                                ₱{{ number_format($property->price ?? 0, 0) }}
                            </div>
                            
                            <div class="flex items-center text-gray-600 mb-6">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-lg">{{ $property->location }}</span>
                            </div>
                            
                            <!-- Property Specs Grid -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                @if($property->property_type)
                                <div class="text-center p-3 bg-gray-50 rounded-lg">
                                    <div class="text-2xl font-bold text-gray-900 capitalize">{{ $property->property_type }}</div>
                                    <div class="text-sm text-gray-600">Type</div>
                                </div>
                                @endif
                                
                                @if($property->bedrooms)
                                <div class="text-center p-3 bg-gray-50 rounded-lg">
                                    <div class="text-2xl font-bold text-gray-900">{{ $property->bedrooms }}</div>
                                    <div class="text-sm text-gray-600">Bedrooms</div>
                                </div>
                                @endif
                                
                                @if($property->bathrooms)
                                <div class="text-center p-3 bg-gray-50 rounded-lg">
                                    <div class="text-2xl font-bold text-gray-900">{{ $property->bathrooms }}</div>
                                    <div class="text-sm text-gray-600">Bathrooms</div>
                                </div>
                                @endif
                                
                                @if($property->area)
                                <div class="text-center p-3 bg-gray-50 rounded-lg">
                                    <div class="text-2xl font-bold text-gray-900">{{ $property->area }}</div>
                                    <div class="text-sm text-gray-600">sqm</div>
                                </div>
                                @endif
                            </div>
                            
                            <!-- Description -->
                            @if($property->description)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                                <p class="text-gray-700 leading-relaxed">{{ $property->description }}</p>
                            </div>
                            @endif
                            
                            <!-- Amenities -->
                            @if($property->amenities && count($property->amenities) > 0)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Amenities</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($property->amenities as $amenity)
                                        <span class="px-3 py-2 bg-blue-100 text-blue-800 rounded-full text-sm">
                                            {{ $amenity }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Comments & Questions ({{ $property->comments->count() }})</h3>
                            
                            @auth
                            <!-- Add Comment Form -->
                            <div class="mb-6">
                                <form id="commentForm" class="space-y-3">
                                    <textarea name="content" rows="3" 
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                              placeholder="Ask a question or leave a comment..."></textarea>
                                    <div class="flex justify-end">
                                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                                            Post Comment
                                        </button>
                                    </div>
                                </form>
                            </div>
                            @else
                            <div class="mb-6 p-4 bg-gray-50 rounded-lg text-center">
                                <p class="text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-600 hover:underline">login</a> to comment or ask questions.</p>
                            </div>
                            @endauth

                            <!-- Comments List -->
                            <div id="commentsList" class="space-y-4">
                                @foreach($property->comments as $comment)
                                    @include('properties.partials.comment', ['comment' => $comment])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    
                    <!-- Contact Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
                            
                            @if($property->phone)
                            <div class="flex items-center mb-3">
                                <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span class="text-gray-700">{{ $property->phone }}</span>
                            </div>
                            @endif
                            
                            <div class="flex items-center mb-3">
                                <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="text-gray-700">{{ $property->user->name }}</span>
                            </div>
                            
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-gray-700">Listed {{ $property->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Reactions -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Reactions</h3>
                            
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <button onclick="toggleReaction({{ $property->id }}, 'like')" 
                                        class="flex items-center justify-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                    <span class="text-xl mr-2">👍</span>
                                    <span class="text-sm">Like</span>
                                </button>
                                
                                <button onclick="toggleReaction({{ $property->id }}, 'love')" 
                                        class="flex items-center justify-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                    <span class="text-xl mr-2">❤️</span>
                                    <span class="text-sm">Love</span>
                                </button>
                                
                                <button onclick="toggleReaction({{ $property->id }}, 'wow')" 
                                        class="flex items-center justify-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                    <span class="text-xl mr-2">😮</span>
                                    <span class="text-sm">Wow</span>
                                </button>
                                
                                <button onclick="toggleReaction({{ $property->id }}, 'helpful')" 
                                        class="flex items-center justify-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                    <span class="text-xl mr-2">💡</span>
                                    <span class="text-sm">Helpful</span>
                                </button>
                            </div>
                            
                            <button onclick="toggleReaction({{ $property->id }}, 'interested')" 
                                    class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition font-medium">
                                💬 I'm Interested
                            </button>
                        </div>
                    </div>

                    <!-- Property Stats -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Property Stats</h3>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Views</span>
                                    <span class="font-semibold">{{ $property->views_count }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Inquiries</span>
                                    <span class="font-semibold">{{ $property->inquiries_count }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Comments</span>
                                    <span class="font-semibold">{{ $property->comments->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function setMainImage(imageSrc) {
        // Update main image when thumbnail is clicked
        const mainImage = document.querySelector('.lg\\:col-span-2 img');
        if (mainImage) {
            mainImage.src = imageSrc;
        }
    }

    function toggleReaction(propertyId, reactionType) {
        // This will be implemented with the reaction system
        console.log('Toggle reaction:', propertyId, reactionType);
    }

    // Comment form submission
    document.getElementById('commentForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append('property_id', {{ $property->id }});
        
        // This will be implemented with the comment system
        console.log('Submit comment:', formData);
    });
    </script>
</x-app-layout>
