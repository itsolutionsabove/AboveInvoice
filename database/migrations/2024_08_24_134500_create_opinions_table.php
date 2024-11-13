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
        Schema::create('opinions', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable(); // URL or path to the image
            $table->string('name');
            $table->string('name_ar');
            $table->integer('rate')->nullable();
            $table->text('comment')->nullable();
            $table->text('comment_ar')->nullable();
            $table->boolean('show_in_home_page')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opinions');
    }
};
