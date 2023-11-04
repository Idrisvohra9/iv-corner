<?php

use App\Models\User;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("title", 60);
            $table->string("slug", 60);
            $table->string("thumbnail", 120);
            $table->longText("body");
            $table->boolean("active");
            $table->datetime("published_at")->default((new DateTime())->format('Y-m-d H:i:s'));
            $table->foreignIdFor(User::class, "user_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
