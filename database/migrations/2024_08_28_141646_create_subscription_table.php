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
        Schema::create('subscription', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Subscription title in default language
            $table->string('title_ar'); // Subscription title in Arabic
            $table->integer('count'); // Count, assuming it's an integer
            $table->decimal('default_price', 8, 2); // Default price, assuming it's a decimal
            $table->decimal('price_after_discount', 8, 2)->nullable(); // Price after discount, nullable
            $table->text('description')->nullable(); // Description in default language, nullable
            $table->text('description_ar')->nullable(); // Description in Arabic, nullable
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription');
    }
};
