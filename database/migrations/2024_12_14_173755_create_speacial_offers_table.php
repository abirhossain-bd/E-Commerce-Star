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
        Schema::create('speacial_offers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('offer');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->string('image');
            $table->enum('status',['active','deactive'])->default('deactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speacial_offers');
    }
};