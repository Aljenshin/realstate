<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->enum('pricing_type', ['sale', 'rent', 'auction'])->default('sale')->after('price');
            $table->decimal('rent_amount', 12, 2)->nullable()->after('pricing_type'); // For rental properties
            $table->string('rent_period')->nullable()->after('rent_amount'); // monthly, yearly, etc.
            $table->decimal('auction_start_price', 12, 2)->nullable()->after('rent_period');
            $table->timestamp('auction_end_date')->nullable()->after('auction_start_price');
            $table->boolean('negotiable')->default(false)->after('auction_end_date');
            $table->decimal('down_payment', 12, 2)->nullable()->after('negotiable');
            $table->decimal('monthly_payment', 12, 2)->nullable()->after('down_payment');
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'pricing_type', 'rent_amount', 'rent_period', 'auction_start_price',
                'auction_end_date', 'negotiable', 'down_payment', 'monthly_payment'
            ]);
        });
    }
};
