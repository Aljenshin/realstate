<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Property Search
            </h2>
            <a href="{{ route('properties.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md text-sm hover:bg-gray-700 transition">
                ← Back to Marketplace
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Search Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('search.index') }}" class="space-y-6">
                        <!-- Search Input -->
                        <div>
                            <label for="q" class="block text-sm font-medium text-gray-700 mb-2">Search Properties</label>
                            <div class="relative">
                                <input type="text" 
                                       name="q" 
                                       id="q" 
                                       value="{{ $query }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Search by title, location, or keywords...">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Filters Row -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Property Type -->
                            <div>
                                <label for="property_type" class="block text-sm font-medium text-gray-700 mb-2">Property Type</label>
                                <select name="property_type" id="property_type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">All Types</option>
                                    <option value="apartment" {{ request('property_type') === 'apartment' ? 'selected' : '' }}>Apartment</option>
                                    <option value="house" {{ request('property_type') === 'house' ? 'selected' : '' }}>House</option>
                                    <option value="condo" {{ request('property_type') === 'condo' ? 'selected' : '' }}>Condo</option>
                                    <option value="land" {{ request('property_type') === 'land' ? 'selected' : '' }}>Land</option>
                                    <option value="commercial" {{ request('property_type') === 'commercial' ? 'selected' : '' }}>Commercial</option>
                                </select>
                            </div>

                            <!-- Location -->
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                                <input type="text" 
                                       name="location" 
                                       id="location" 
                                       value="{{ request('location') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="City or area">
                            </div>

                            <!-- Max Price -->
                            <div>
                                <label for="max_price" class="block text-sm font-medium text-gray-700 mb-2">Max Price</label>
                                <input type="number" 
                                       name="max_price" 
                                       id="max_price" 
                                       value="{{ request('max_price') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="₱0">
                            </div>

                            <!-- Sort -->
                            <div>
                                <label for="sort" class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                                <select name="sort" id="sort" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest First</option>
                                    <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="featured" {{ request('sort') === 'featured' ? 'selected' : '' }}>Featured First</option>
                                </select>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-between items-center">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                                🔍 Search Properties
                            </button>
                            <a href="{{ route('search.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">
                                Clear Filters
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Search Results -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Search Results
                            @if($query)
                                for "{{ $query }}"
                            @endif
                            ({{ $properties->total() }} properties found)
                        </h3>
                        
                        @if($properties->total() > 0)
                            <div class="text-sm text-gray-600">
                                Showing {{ $properties->firstItem() }}-{{ $properties->lastItem() }} of {{ $properties->total() }}
                            </div>
                        @endif
                    </div>

                    @if($properties->count() > 0)
                        <!-- Properties Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($properties as $property)
                                @include('properties.partials.property-card', ['property' => $property])
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $properties->appends(request()->query())->links() }}
                        </div>
                    @else
                        <!-- No Results -->
                        <div class="text-center py-12">
                            <div class="text-gray-400 text-6xl mb-4">🔍</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No properties found</h3>
                            <p class="text-gray-600 mb-4">
                                @if($query)
                                    No properties match your search for "{{ $query }}". Try adjusting your filters or search terms.
                                @else
                                    No properties match your current filters. Try adjusting your search criteria.
                                @endif
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <a href="{{ route('search.index') }}" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                                    Clear Filters
                                </a>
                                <a href="{{ route('properties.index') }}" class="bg-gray-600 text-white px-6 py-2 rounded-md hover:bg-gray-700 transition">
                                    Browse All Properties
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Popular Searches -->
            @if($popularSearches->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Popular Searches</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($popularSearches as $search)
                            <a href="{{ route('search.index', ['q' => $search->search_query]) }}" 
                               class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm hover:bg-blue-200 transition">
                                {{ $search->search_query }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <script>
        // Auto-submit form when filters change
        document.querySelectorAll('select[name="property_type"], select[name="sort"]').forEach(select => {
            select.addEventListener('change', function() {
                this.closest('form').submit();
            });
        });

        // Debounced search input
        let searchTimeout;
        document.getElementById('q').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                this.closest('form').submit();
            }, 500);
        });
    </script>
</x-app-layout>
