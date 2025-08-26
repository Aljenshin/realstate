<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Your Property') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Basic Information -->
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="title" value="Property Title *" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" 
                                                 placeholder="e.g., Modern 2BR Apartment in BGC" required />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="property_type" value="Property Type *" />
                                        <select id="property_type" name="property_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" required>
                                            <option value="">Select Type</option>
                                            <option value="apartment">Apartment</option>
                                            <option value="house">House</option>
                                            <option value="condo">Condo</option>
                                            <option value="land">Land</option>
                                            <option value="commercial">Commercial</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('property_type')" class="mt-2" />
                                    </div>
                                    
                                    <div>
                                        <x-input-label for="location" value="Location *" />
                                        <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" 
                                                     placeholder="e.g., Bonifacio Global City, Taguig" required />
                                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <x-input-label for="price" value="Price (₱) *" />
                                        <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" 
                                                     placeholder="e.g., 25000000" required />
                                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                    </div>
                                    
                                    <div>
                                        <x-input-label for="bedrooms" value="Bedrooms" />
                                        <x-text-input id="bedrooms" name="bedrooms" type="number" min="0" class="mt-1 block w-full" 
                                                     placeholder="e.g., 2" />
                                        <x-input-error :messages="$errors->get('bedrooms')" class="mt-2" />
                                    </div>
                                    
                                    <div>
                                        <x-input-label for="bathrooms" value="Bathrooms" />
                                        <x-text-input id="bathrooms" name="bathrooms" type="number" min="0" class="mt-1 block w-full" 
                                                     placeholder="e.g., 2" />
                                        <x-input-error :messages="$errors->get('bathrooms')" class="mt-2" />
                                    </div>
                                </div>

                                <div>
                                    <x-input-label for="area" value="Area (sqm)" />
                                    <x-text-input id="area" name="area" type="number" step="0.01" class="mt-1 block w-full" 
                                                 placeholder="e.g., 75.5" />
                                    <x-input-error :messages="$errors->get('area')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h3>
                            
                            <div>
                                <x-input-label for="phone" value="Phone Number" />
                                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" 
                                             placeholder="e.g., +63 912 345 6789" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Description</h3>
                            
                            <div>
                                <x-input-label for="description" value="Property Description" />
                                <textarea id="description" name="description" rows="5" 
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                                          placeholder="Describe your property in detail..."></textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Amenities -->
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Amenities</h3>
                            
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                @php
                                    $commonAmenities = [
                                        'Swimming Pool', 'Gym', '24/7 Security', 'Parking', 'Garden',
                                        'Elevator', 'Water Supply', 'Electricity', 'Security System',
                                        'Water Tank', 'Modern Kitchen', 'Concierge', 'Valet Parking',
                                        'Rooftop Garden', 'Near MRT', 'Near Mall', 'Near School'
                                    ];
                                @endphp
                                
                                @foreach($commonAmenities as $amenity)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="amenities[]" value="{{ $amenity }}" 
                                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-200">
                                        <span class="ml-2 text-sm text-gray-700">{{ $amenity }}</span>
                                    </label>
                                @endforeach
                            </div>
                            
                            <div class="mt-3">
                                <x-input-label for="custom_amenities" value="Other Amenities (comma-separated)" />
                                <x-text-input id="custom_amenities" name="custom_amenities" type="text" class="mt-1 block w-full" 
                                             placeholder="e.g., Smart home system, Solar panels" />
                            </div>
                        </div>

                        <!-- Search Optimization -->
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Search Optimization</h3>
                            
                            <div>
                                <x-input-label for="search_tags" value="Search Tags (comma-separated)" />
                                <x-text-input id="search_tags" name="search_tags" type="text" class="mt-1 block w-full" 
                                             placeholder="e.g., modern, furnished, swimming pool, gym, parking" />
                                <p class="mt-1 text-sm text-gray-500">Add relevant keywords to help buyers find your property</p>
                                <x-input-error :messages="$errors->get('search_tags')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Photos -->
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Property Photos *</h3>
                            
                            <div>
                                <x-input-label for="images" value="Upload Photos (you can select multiple)" />
                                <input id="images" name="images[]" type="file" multiple accept="image/*" 
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" required />
                                <p class="mt-1 text-sm text-gray-500">Upload at least 1 photo. First photo will be the featured image.</p>
                                <x-input-error :messages="$errors->get('images.*')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="flex justify-between items-center">
                            <a href="{{ route('properties.index') }}" class="text-gray-600 hover:text-gray-800">
                                ← Back to Marketplace
                            </a>
                            <x-primary-button class="px-8 py-3">
                                🏠 List Property
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Handle custom amenities
    document.getElementById('custom_amenities').addEventListener('input', function() {
        const customAmenities = this.value.split(',').map(item => item.trim()).filter(item => item);
        
        // You can add logic here to dynamically add custom amenities to the amenities array
        console.log('Custom amenities:', customAmenities);
    });
    </script>
</x-app-layout>



