<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Marketplace Dashboard') }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('properties.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700 transition">
                    + List New Property
                </a>
                <a href="{{ route('search.analytics') }}" class="bg-green-600 text-white px-4 py-2 rounded-md text-sm hover:bg-green-700 transition">
                    📊 Analytics
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Section -->
            <div class="bg-white/90 backdrop-blur-sm rounded-lg p-6 mb-6 shadow-lg border border-white/20">
                <h1 class="text-3xl font-bold mb-2 text-gray-800">Welcome back, {{ Auth::user()->name }}! 🎉</h1>
                <p class="text-gray-600 text-lg">Manage your properties, track performance, and discover new opportunities.</p>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-lg rounded-lg border border-white/20">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-100 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Properties</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $properties->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-lg rounded-lg border border-white/20">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Views</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $properties->sum('views_count') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-lg rounded-lg border border-white/20">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-100 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Inquiries</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $properties->sum('inquiries_count') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-lg rounded-lg border border-white/20">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-100 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Featured</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $properties->where('is_featured', true)->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-lg rounded-lg mb-6 border border-white/20">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('properties.create') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">List New Property</h4>
                                <p class="text-sm text-gray-500">Add your property to the marketplace</p>
                            </div>
                        </a>

                        <a href="{{ route('properties.my-properties') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-green-300 hover:bg-green-50 transition">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">My Properties</h4>
                                <p class="text-sm text-gray-500">Manage your listings</p>
                            </div>
                        </a>

                        <a href="{{ route('properties.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-purple-300 hover:bg-purple-50 transition">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Browse Marketplace</h4>
                                <p class="text-sm text-gray-500">Discover new properties</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-lg rounded-lg mb-6 border border-white/20">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
                    
                    @if($properties->count() > 0)
                        <div class="space-y-4">
                            @foreach($properties->take(5) as $property)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        @if($property->featured_image_url)
                                            <img src="{{ $property->featured_image_url }}" 
                                                 class="w-12 h-12 object-cover rounded-lg mr-4" 
                                                 alt="{{ $property->title }}">
                                        @else
                                            <div class="w-12 h-12 bg-gray-200 rounded-lg mr-4 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ $property->title }}</h4>
                                            <p class="text-sm text-gray-500">{{ $property->location }} • {{ $property->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg font-semibold text-blue-600">₱{{ number_format($property->price) }}</div>
                                        <div class="text-sm text-gray-500">{{ $property->views_count }} views</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        @if($properties->count() > 5)
                            <div class="mt-4 text-center">
                                <a href="{{ route('properties.my-properties') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    View All Properties →
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-8">
                            <div class="text-gray-400 text-4xl mb-2">🏠</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No properties listed yet</h3>
                            <p class="text-gray-600 mb-4">Start by listing your first property to reach potential buyers or renters!</p>
                            <a href="{{ route('properties.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                                List Your First Property
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Performance Insights -->
            @if($properties->count() > 0)
            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-lg rounded-lg mb-6 border border-white/20">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Performance Insights</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-gray-700 mb-3">Top Performing Properties</h4>
                            @foreach($properties->sortByDesc('views_count')->take(3) as $property)
                                <div class="flex items-center justify-between mb-3 p-3 bg-gray-50 rounded">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-blue-600 font-semibold text-sm">{{ $loop->iteration }}</span>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900 text-sm">{{ $property->title }}</p>
                                            <p class="text-xs text-gray-500">{{ $property->location }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-semibold text-gray-900">{{ $property->views_count }}</p>
                                        <p class="text-xs text-gray-500">views</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div>
                            <h4 class="font-medium text-gray-700 mb-3">Recent Inquiries</h4>
                            @if($properties->sum('inquiries_count') > 0)
                                @foreach($properties->where('inquiries_count', '>', 0)->sortByDesc('inquiries_count')->take(3) as $property)
                                    <div class="flex items-center justify-between mb-3 p-3 bg-green-50 rounded">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-green-600 font-semibold text-sm">💬</span>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900 text-sm">{{ $property->title }}</p>
                                                <p class="text-xs text-gray-500">{{ $property->inquiries_count }} inquiries</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('properties.show', $property) }}" class="text-blue-600 hover:text-blue-800 text-xs">
                                            View →
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-8">
                                    <div class="text-gray-400 text-2xl mb-2">💬</div>
                                    <p class="text-sm text-gray-500">No inquiries yet</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Market Trends -->
            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-lg rounded-lg border border-white/20">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Market Trends</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center p-4 bg-blue-50 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">{{ $properties->where('property_type', 'apartment')->count() }}</div>
                            <div class="text-sm text-gray-600">Apartments</div>
                        </div>
                        <div class="text-center p-4 bg-green-50 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">{{ $properties->where('property_type', 'house')->count() }}</div>
                            <div class="text-sm text-gray-600">Houses</div>
                        </div>
                        <div class="text-center p-4 bg-purple-50 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600">{{ $properties->where('property_type', 'condo')->count() }}</div>
                            <div class="text-sm text-gray-600">Condos</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
