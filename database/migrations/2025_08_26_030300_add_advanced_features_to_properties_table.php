<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Virtual tour and media
            $table->string('virtual_tour_url')->nullable()->after('featured_image');
            $table->string('video_url')->nullable()->after('virtual_tour_url');
            $table->json('360_photos')->nullable()->after('video_url'); // Array of 360° photo URLs
            
            // Property details
            $table->string('parking_spaces')->nullable()->after('area');
            $table->string('furnishing_status')->nullable()->after('parking_spaces'); // furnished, semi-furnished, unfurnished
            $table->string('floor_number')->nullable()->after('furnishing_status');
            $table->string('total_floors')->nullable()->after('floor_number');
            $table->string('age_of_property')->nullable()->after('total_floors');
            $table->string('facing_direction')->nullable()->after('age_of_property');
            
            // Legal and documents
            $table->string('property_tax')->nullable()->after('facing_direction');
            $table->string('maintenance_charges')->nullable()->after('property_tax');
            $table->json('documents')->nullable()->after('maintenance_charges'); // Array of document URLs
            
            // Location details
            $table->decimal('latitude', 10, 8)->nullable()->after('location');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            $table->string('landmark')->nullable()->after('longitude');
            $table->string('metro_station')->nullable()->after('landmark');
            $table->string('bus_stop')->nullable()->after('metro_station');
            
            // Advanced search
            $table->json('nearby_amenities')->nullable()->after('bus_stop');
            $table->json('schools')->nullable()->after('nearby_amenities');
            $table->json('hospitals')->nullable()->after('schools');
            $table->json('shopping_centers')->nullable()->after('hospitals');
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'virtual_tour_url', 'video_url', '360_photos', 'parking_spaces',
                'furnishing_status', 'floor_number', 'total_floors', 'age_of_property',
                'facing_direction', 'property_tax', 'maintenance_charges', 'documents',
                'latitude', 'longitude', 'landmark', 'metro_station', 'bus_stop',
                'nearby_amenities', 'schools', 'hospitals', 'shopping_centers'
            ]);
        });
    }
};
