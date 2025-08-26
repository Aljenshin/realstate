<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Property Marketplace') }}
            </h2>
            <a href="{{ route('properties.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700 transition">
                + List Your Property
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Search and Filters Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('properties.index') }}" method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Search Input -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                                <input type="text" name="q" value="{{ request('q') }}" 
                                       placeholder="Search properties..." 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            
                            <!-- Property Type -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                                <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">All Types</option>
                                    <option value="apartment" {{ request('type') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                                    <option value="house" {{ request('type') == 'house' ? 'selected' : '' }}>House</option>
                                    <option value="condo" {{ request('type') == 'condo' ? 'selected' : '' }}>Condo</option>
                                    <option value="land" {{ request('type') == 'land' ? 'selected' : '' }}>Land</option>
                                    <option value="commercial" {{ request('type') == 'commercial' ? 'selected' : '' }}>Commercial</option>
                                </select>
                            </div>
                            
                            <!-- Location -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                                <input type="text" name="location" value="{{ request('location') }}" 
                                       placeholder="City or area..." 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            
                            <!-- Price Range -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Max Price</label>
                                <select name="max_price" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Any Price</option>
                                    <option value="5000000" {{ request('max_price') == '5000000' ? 'selected' : '' }}>Under ₱5M</option>
                                    <option value="10000000" {{ request('max_price') == '10000000' ? 'selected' : '' }}>Under ₱10M</option>
                                    <option value="20000000" {{ request('max_price') == '20000000' ? 'selected' : '' }}>Under ₱20M</option>
                                    <option value="50000000" {{ request('max_price') == '50000000' ? 'selected' : '' }}>Under ₱50M</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                                🔍 Search Properties
                            </button>
                            <a href="{{ route('properties.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">
                                Clear Filters
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Featured Properties Section -->
            @if($properties->where('is_featured', true)->count() > 0)
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    ⭐ Featured Properties
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($properties->where('is_featured', true)->take(3) as $featured)
                        @include('properties.partials.property-card', ['property' => $featured, 'featured' => true])
                    @endforeach
                </div>
            </div>
            @endif

            <!-- All Properties Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">
                            All Properties ({{ $properties->total() }})
                        </h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('properties.index', array_merge(request()->query(), ['sort' => 'newest'])) }}" 
                               class="px-3 py-1 text-sm {{ request('sort', 'newest') == 'newest' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-700' }} rounded-md">
                                Newest
                            </a>
                            <a href="{{ route('properties.index', array_merge(request()->query(), ['sort' => 'price_low'])) }}" 
                               class="px-3 py-1 text-sm {{ request('sort') == 'price_low' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-700' }} rounded-md">
                                Price: Low to High
                            </a>
                            <a href="{{ route('properties.index', array_merge(request()->query(), ['sort' => 'price_high'])) }}" 
                               class="px-3 py-1 text-sm {{ request('sort') == 'price_high' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-700' }} rounded-md">
                                Price: High to Low
                            </a>
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($properties as $property)
                            @include('properties.partials.property-card', ['property' => $property])
                        @empty
                            <div class="col-span-full text-center py-12">
                                <div class="text-gray-400 text-6xl mb-4">🏠</div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No properties found</h3>
                                <p class="text-gray-600 mb-4">Try adjusting your search criteria or be the first to list a property!</p>
                                <a href="{{ route('properties.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                                    List Your Property
                                </a>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-8">{{ $properties->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



