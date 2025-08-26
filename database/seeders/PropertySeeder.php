<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\User;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Storage;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        // Get or create a sample user
        $user = User::firstOrCreate(
            ['email' => 'sample@example.com'],
            [
                'name' => 'Sample User',
                'password' => bcrypt('password'),
            ]
        );

        // Sample properties data
        $properties = [
            [
                'title' => 'Modern 2BR Apartment in BGC',
                'location' => 'Bonifacio Global City, Taguig',
                'price' => 25000000,
                'property_type' => 'apartment',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'area' => 75.5,
                'description' => 'Beautiful modern apartment in the heart of BGC. Walking distance to malls, restaurants, and offices. Fully furnished with modern amenities.',
                'amenities' => ['Swimming Pool', 'Gym', '24/7 Security', 'Parking', 'Garden'],
                'search_tags' => 'BGC, modern, furnished, swimming pool, gym, parking',
                'phone' => '+63 912 345 6789',
                'is_featured' => true,
            ],
            [
                'title' => 'Cozy 1BR Studio in Makati',
                'location' => 'Makati City, Metro Manila',
                'price' => 8500000,
                'property_type' => 'apartment',
                'bedrooms' => 1,
                'bathrooms' => 1,
                'area' => 45.0,
                'description' => 'Perfect starter home in Makati. Near Ayala Triangle, Greenbelt, and major business districts. Great investment property.',
                'amenities' => ['24/7 Security', 'Elevator', 'Water Supply', 'Electricity'],
                'search_tags' => 'Makati, studio, investment, Ayala, Greenbelt',
                'phone' => '+63 923 456 7890',
                'is_featured' => false,
            ],
            [
                'title' => 'Spacious 3BR House in Quezon City',
                'location' => 'Quezon City, Metro Manila',
                'price' => 18000000,
                'property_type' => 'house',
                'bedrooms' => 3,
                'bathrooms' => 3,
                'area' => 120.0,
                'description' => 'Family-friendly house in a quiet neighborhood. Large backyard, garage for 2 cars, and modern kitchen. Perfect for growing families.',
                'amenities' => ['Garden', 'Garage', 'Modern Kitchen', 'Security System', 'Water Tank'],
                'search_tags' => 'Quezon City, house, family, garden, garage, quiet',
                'phone' => '+63 934 567 8901',
                'is_featured' => true,
            ],
            [
                'title' => 'Luxury 2BR Condo in Ortigas',
                'location' => 'Ortigas Center, Pasig',
                'price' => 32000000,
                'property_type' => 'condo',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'area' => 85.0,
                'description' => 'High-end condo with premium finishes. Stunning city views, access to exclusive amenities. Walking distance to SM Megamall and The Podium.',
                'amenities' => ['Swimming Pool', 'Gym', 'Spa', 'Concierge', 'Valet Parking', 'Rooftop Garden'],
                'search_tags' => 'Ortigas, luxury, premium, SM Megamall, city view, exclusive',
                'phone' => '+63 945 678 9012',
                'is_featured' => true,
            ],
            [
                'title' => 'Affordable 1BR in Mandaluyong',
                'location' => 'Mandaluyong City, Metro Manila',
                'price' => 6500000,
                'property_type' => 'apartment',
                'bedrooms' => 1,
                'bathrooms' => 1,
                'area' => 40.0,
                'description' => 'Budget-friendly apartment perfect for young professionals. Near MRT station and shopping centers. Good rental income potential.',
                'amenities' => ['24/7 Security', 'Water Supply', 'Electricity', 'Near MRT'],
                'search_tags' => 'Mandaluyong, affordable, MRT, budget, rental income',
                'phone' => '+63 956 789 0123',
                'is_featured' => false,
            ],
            [
                'title' => 'Beautiful 4BR Family House in Alabang',
                'location' => 'Alabang, Muntinlupa',
                'price' => 45000000,
                'property_type' => 'house',
                'bedrooms' => 4,
                'bathrooms' => 4,
                'area' => 200.0,
                'description' => 'Spacious family home in exclusive Alabang village. Large lot, swimming pool, and beautiful garden. Perfect for luxury family living.',
                'amenities' => ['Swimming Pool', 'Garden', 'Garage', 'Security System', 'Water Tank', 'Modern Kitchen'],
                'search_tags' => 'Alabang, luxury, family, swimming pool, garden, exclusive',
                'phone' => '+63 967 890 1234',
                'is_featured' => true,
            ],
        ];

        foreach ($properties as $propertyData) {
            $property = Property::create([
                'user_id' => $user->id,
                'title' => $propertyData['title'],
                'location' => $propertyData['location'],
                'price' => $propertyData['price'],
                'property_type' => $propertyData['property_type'],
                'bedrooms' => $propertyData['bedrooms'],
                'bathrooms' => $propertyData['bathrooms'],
                'area' => $propertyData['area'],
                'description' => $propertyData['description'],
                'amenities' => $propertyData['amenities'],
                'search_tags' => $propertyData['search_tags'],
                'phone' => $propertyData['phone'],
                'is_featured' => $propertyData['is_featured'],
                'status' => 'active',
                'slug' => \Str::slug($propertyData['title']),
                'meta_description' => \Str::limit($propertyData['description'], 160),
            ]);

            // Create sample images (placeholder paths)
            for ($i = 0; $i < 3; $i++) {
                PropertyImage::create([
                    'property_id' => $property->id,
                    'path' => 'sample-images/property-' . $property->id . '-image-' . ($i + 1) . '.jpg',
                    'position' => $i,
                ]);
            }

            // Set first image as featured
            if ($property->images->count() > 0) {
                $property->update(['featured_image' => $property->images->first()->path]);
            }
        }

        $this->command->info('Sample properties created successfully!');
    }
}
