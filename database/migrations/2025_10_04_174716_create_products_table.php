<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Product owner
            $table->string('name'); // Product name
            $table->decimal('price', 10, 2); // Price with 2 decimal places
            $table->date('expiry_date'); // Expiry date
            $table->string('card_background_color_one')->nullable(); // Color code (e.g. #ff0000)
            $table->string('card_background_color_two')->nullable(); // Color code (e.g. #ff0000)
            $table->string('attachment')->nullable(); // Image path
            $table->text('description')->nullable(); // Product description
            $table->boolean('status')->default(true); // true = available, false = unavailable
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
