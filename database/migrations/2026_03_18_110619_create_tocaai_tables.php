<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("musicians", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("slug")->unique();
            $table->text("bio")->nullable();
            $table->boolean("is_active")->default(true);
            $table->timestamps();
        });

        Schema::create("songs", function (Blueprint $table) {
            $table->id();
            $table->foreignId("musician_id")->constrained();
            $table->string("title");
            $table->string("artist_original");
            $table->timestamps();
        });

        Schema::create("song_requests", function (Blueprint $table) {
            $table->id();
            $table->foreignId("song_id")->constrained();
            $table->string("customer_name");
            $table->decimal("amount", 8, 2)->default(5.00);
            $table->string("status")->default("pending");
            $table->text("message")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists("song_requests");
        Schema::dropIfExists("songs");
        Schema::dropIfExists("musicians");
    }
};
