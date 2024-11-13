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
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->after('name')->nullable();
            $table->string('image')->after('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('country_code', 5)->nullable(); // Adjust length if needed
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->boolean('subscription')->default(false); // Adjust default value if needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['last_name', 'image', 'phone', 'country_code', 'gender', 'subscription']);
        });
    }
};
