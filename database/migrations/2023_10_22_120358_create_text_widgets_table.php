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
        Schema::create('text_widgets', function (Blueprint $table) {
            $table->id();
            $table->string("title", 1000)->unique();
            $table->string("image", 1000)->nullable();
            $table->longText('content')->nullable();
            $table->json('config')->nullable(); // For widget configuration
            $table->json("categories")->nullable()->toArray();
            $table->string("url", 1000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('text_widgets');
    }
};
