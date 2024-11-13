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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("name_ar");
            $table->float("default_price");
            $table->string("default_image")->nullable();
            $table->longText("images")->nullable();
            $table->integer("default_rate")->default(0);
            $table->string('calories')->nullable();
            $table->string("serving_size")->nullable();
            $table->longText("description")->nullable();
            $table->longText("description_ar")->nullable();
            $table->longText("fact_detail")->nullable();
            $table->longText("fact_detail_ar")->nullable();
            $table->boolean('visibility')->default(true);
            

            $table->timestamps();
            $table->softDeletes(); 
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