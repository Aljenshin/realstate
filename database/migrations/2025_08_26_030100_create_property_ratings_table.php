<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->integer('rating'); // 1-5 stars
            $table->text('review')->nullable();
            $table->boolean('is_verified_viewer')->default(false); // Has actually viewed the property
            $table->timestamps();
            
            $table->unique(['user_id', 'property_id']);
            $table->index(['property_id', 'rating']);
            $table->index(['user_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_ratings');
    }
};
