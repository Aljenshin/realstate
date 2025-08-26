<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->enum('property_type', ['apartment', 'house', 'condo', 'land', 'commercial'])->default('apartment');
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->decimal('area', 10, 2)->nullable(); // in square meters
            $table->json('amenities')->nullable(); // array of amenities
            $table->text('search_tags')->nullable(); // comma-separated tags for search
            $table->string('slug')->unique()->nullable(); // SEO-friendly URL
            $table->text('meta_description')->nullable(); // SEO meta description
            $table->string('featured_image')->nullable(); // main image path
            $table->boolean('is_featured')->default(false);
            $table->integer('views_count')->default(0);
            $table->integer('inquiries_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'property_type', 'bedrooms', 'bathrooms', 'area', 
                'amenities', 'search_tags', 'slug', 'meta_description',
                'featured_image', 'is_featured', 'views_count', 'inquiries_count'
            ]);
        });
    }
};
