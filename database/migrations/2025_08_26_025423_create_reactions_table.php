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
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->enum('reaction_type', ['like', 'love', 'wow', 'helpful', 'interested']);
            $table->timestamps();
            
            $table->unique(['user_id', 'property_id']);
            $table->index(['property_id', 'reaction_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
};
