<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Properties') }}
            </h2>
            <a href="{{ route('properties.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700 transition">
                + List New Property
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">{{ session('status') }}</div>
            @endif

            <!-- Properties Grid -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">
                            My Listings ({{ $properties->total() }})
                        </h3>
                        <a href="{{ route('properties.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                            Browse All Properties →
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($properties as $property)
                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200">
                                <!-- Property Image -->
                                <div class="relative">
                                    @if($property->featured_image)
                                        <img src="{{ Storage::disk('public')->url($property->featured_image) }}" 
                                             class="w-full h-48 object-cover" 
                                             alt="{{ $property->title }}">
                                    @else
                                        <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center">
                                            <div class="text-center">
                                                <div class="text-4xl text-gray-400 mb-2">🏠</div>
                                                <div class="text-sm text-gray-500">No Image</div>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <!-- Status Badge -->
                                    <div class="absolute top-2 left-2">
                                        @if($property->status === 'active')
                                            <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                                Active
                                            </span>
                                        @elseif($property->status === 'sold')
                                            <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                                Sold
                                            </span>
                                        @else
                                            <span class="bg-gray-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                                Inactive
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <!-- Featured Badge -->
                                    @if($property->is_featured)
                                        <div class="absolute top-2 right-2 bg-yellow-400 text-yellow-900 px-2 py-1 rounded-full text-xs font-semibold">
                                            ⭐ Featured
                                        </span>
                                    @endif
                                </div>

                                <!-- Property Details -->
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 text-lg mb-2">{{ $property->title }}</h3>
                                    <div class="text-sm text-gray-600 mb-2">{{ $property->location }}</div>
                                    <div class="text-xl font-bold text-blue-600 mb-3">₱{{ number_format($property->price ?? 0, 0) }}</div>
                                    
                                    <!-- Property Specs -->
                                    <div class="grid grid-cols-3 gap-2 mb-4">
                                        @if($property->bedrooms)
                                        <div class="text-center p-2 bg-gray-50 rounded">
                                            <div class="text-sm font-semibold text-gray-900">{{ $property->bedrooms }}</div>
                                            <div class="text-xs text-gray-600">Bedrooms</div>
                                        </div>
                                        @endif
                                        
                                        @if($property->bathrooms)
                                        <div class="text-center p-2 bg-gray-50 rounded">
                                            <div class="text-sm font-semibold text-gray-900">{{ $property->bathrooms }}</div>
                                            <div class="text-xs text-gray-600">Bathrooms</div>
                                        </div>
                                        @endif
                                        
                                        @if($property->area)
                                        <div class="text-center p-2 bg-gray-50 rounded">
                                            <div class="text-sm font-semibold text-gray-900">{{ $property->area }}</div>
                                            <div class="text-xs text-gray-600">sqm</div>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Stats -->
                                    <div class="flex justify-between items-center text-xs text-gray-500 mb-4">
                                        <span>👁️ {{ $property->views_count }} views</span>
                                        <span>💬 {{ $property->comments->count() }} comments</span>
                                        <span>📅 {{ $property->created_at->diffForHumans() }}</span>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex space-x-2">
                                        <a href="{{ route('properties.show', $property) }}" 
                                           class="flex-1 bg-blue-600 text-white text-center py-2 px-4 rounded-md hover:bg-blue-700 transition text-sm font-medium">
                                            View
                                        </a>
                                        
                                        <a href="{{ route('properties.edit', $property) }}" 
                                           class="flex-1 bg-green-600 text-white text-center py-2 px-4 rounded-md hover:bg-green-700 transition text-sm font-medium">
                                            Edit
                                        </a>
                                        
                                        <button onclick="deleteProperty({{ $property->id }})" 
                                                class="flex-1 bg-red-600 text-white text-center py-2 px-4 rounded-md hover:bg-red-700 transition text-sm font-medium">
                                            Delete
                                        </button>
                                    </div>

                                    <!-- Featured Toggle -->
                                    @if($property->status === 'active')
                                    <div class="mt-3">
                                        <button onclick="toggleFeatured({{ $property->id }})" 
                                                class="w-full py-2 px-4 border border-gray-300 rounded-md hover:bg-gray-50 transition text-sm {{ $property->is_featured ? 'bg-yellow-100 border-yellow-300 text-yellow-800' : 'bg-gray-50 text-gray-700' }}">
                                            {{ $property->is_featured ? '⭐ Remove from Featured' : '⭐ Mark as Featured' }}
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12">
                                <div class="text-gray-400 text-6xl mb-4">🏠</div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No properties listed yet</h3>
                                <p class="text-gray-600 mb-4">Start by listing your first property to reach potential buyers or renters!</p>
                                <a href="{{ route('properties.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                                    List Your First Property
                                </a>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-8">{{ $properties->links() }}</div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function deleteProperty(propertyId) {
        if (confirm('Are you sure you want to delete this property? This action cannot be undone.')) {
            // Create a form to submit the delete request
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/properties/${propertyId}`;
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            const tokenField = document.createElement('input');
            tokenField.type = 'hidden';
            tokenField.name = '_token';
            tokenField.value = '{{ csrf_token() }}';
            
            form.appendChild(methodField);
            form.appendChild(tokenField);
            document.body.appendChild(form);
            form.submit();
        }
    }

    function toggleFeatured(propertyId) {
        fetch(`/properties/${propertyId}/toggle-featured`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Reload the page to show updated state
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the property.');
        });
    }
    </script>
</x-app-layout>
