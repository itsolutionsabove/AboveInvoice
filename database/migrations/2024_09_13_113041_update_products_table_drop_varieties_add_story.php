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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('varieties');
            $table->string('story')->nullable()->after('serving_size'); // Story, nullable
            $table->string('story_ar')->nullable()->after('story'); // Story Arabic, nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('varieties')->nullable();
            $table->dropColumn('story');
        });
    }
};
